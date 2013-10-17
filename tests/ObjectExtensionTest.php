<?php
require_once 'PortalClientTestCase.php';

class ObjectExtensionTest extends PortalClientTestCase
{
	public function testGetByObjectGUID()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUID(
			self::$data['objects'][1]['guid'],
			self::$accessPointGUID
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(1, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetByObjectGUIDs()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUIDs(
			array(self::$data['objects'][0]['guid'],
			      self::$data['objects'][1]['guid'],
			      self::$data['objects'][2]['guid']),
			self::$accessPointGUID
		);
		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(3, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetSearchSchema()
	{
		$serviceResult = self::$client->Object()->GetSearchSchema(
			"test"
			, self::$data['metadata_schemas'][0]['guid']
			, self::$data['metadatas'][0]['language_code']
			, self::$accessPointGUID
			, 0
			, $pageSize = 1
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetSearchSchemas()
	{
		$serviceResult = self::$client->Object()->GetSearchSchemas(
			"a"
			, array(self::$data['metadata_schemas'][0]['guid'],
			        self::$data['metadata_schemas'][1]['guid'],
			        self::$data['metadata_schemas'][2]['guid'])
			, self::$data['metadatas'][0]['language_code']
			, self::$accessPointGUID
			, 0
			, $pageSize = 3
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

 	public function testGetByFolderID()
 	{
 		$serviceResult = self::$client->Object()->GetByFolderID(
			self::$data['folders'][0]['id'],
			false,
			self::$authenticated ? null : self::$accessPointGUID, // WTF
 			0,
 			$pageSize = 5
 		);

 		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
 		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
 	}
}
?>
