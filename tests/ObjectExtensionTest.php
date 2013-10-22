<?php
require_once 'PortalClientTestCase.php';

class ObjectExtensionTest extends PortalClientTestCase
{
	public function testGetByObjectGUID()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUID(
			self::$data['object'][1]['guid'],
			self::$authenticated ? null : self::$config['access_point_guid'] // WTF
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(1, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetByObjectGUIDs()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUIDs(
			$objectGUIDs = array(self::$data['object'][0]['guid'],
			      self::$data['object'][1]['guid'],
			      self::$data['object'][2]['guid']),
			self::$authenticated ? null : self::$config['access_point_guid'] // WTF
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(count($objectGUIDs), $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetSearchSchema()
	{
		$serviceResult = self::$client->Object()->GetSearchSchema(
			"test"
			, self::$data['metadata_schema'][0]['guid']
			, self::$data['metadata'][0]['language_code']
			, self::$config['access_point_guid']
			, 0
			, $pageSize = 1
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetSearchSchemas()
	{
		$serviceResult = self::$client->Object()->GetSearchSchemas(
			"a"
			, array(self::$data['metadata_schema'][0]['guid'],
			        self::$data['metadata_schema'][1]['guid'],
			        self::$data['metadata_schema'][2]['guid'])
			, self::$data['metadata'][0]['language_code']
			, self::$config['access_point_guid']
			, 0
			, $pageSize = 3
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

 	public function testGetByFolderID()
 	{
 		$serviceResult = self::$client->Object()->GetByFolderID(
			self::$data['folder'][0]['id'],
			false,
			self::$authenticated ? null : self::$config['access_point_guid'], // WTF
 			0,
 			$pageSize = 5
 		);

 		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
 		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
 	}
}
?>
