<?php
require_once 'PortalClientTestCase.php';

class ObjectExtensionTest extends PortalClientTestCase
{
	public function testGetByObjectGUID()
	{
		$expected = self::$data['object'][1];

		$serviceResult = self::$client->Object()->GetByObjectGUID(
			$expected['guid'],
			self::$authenticated ? null : self::$config['access_point_guid'] // WTF
		);

		$this->assertSuccess($serviceResult);

		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(1, $serviceResult->MCM()->Count(), "Returned correct number of objects");

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($expected['guid'], $actual->GUID, "Returned correct object");
	}

	public function testGetByObjectGUIDs()
	{
		$expected = array(
			self::$data['object'][0]['guid'],
			self::$data['object'][1]['guid'],
			self::$data['object'][2]['guid']
		);

		$serviceResult = self::$client->Object()->GetByObjectGUIDs(
			$expected,
			self::$authenticated ? null : self::$config['access_point_guid'] // WTF
		);

		$this->assertSuccess($serviceResult);

		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(
			count($expected),
			$serviceResult->MCM()->Count(),
			"Returned correct number of objects"
		);
	}

	public function testGetSearchSchema()
	{
		$serviceResult = self::$client->Object()->GetSearchSchema(
			"test",
			self::$data['metadata_schema'][0]['guid'],
			self::$data['metadata'][0]['language_code'],
			self::$authenticated ? null : self::$config['access_point_guid'], // WTF
			0,
			1
		);

		$this->assertSuccess($serviceResult);

		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(1, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetSearchSchemas()
	{
		$expected = array(
			self::$data['metadata_schema'][0]['guid'],
			self::$data['metadata_schema'][1]['guid'],
			self::$data['metadata_schema'][2]['guid']
		);

		$serviceResult = self::$client->Object()->GetSearchSchemas(
			"a",
			$expected,
			self::$data['metadata'][0]['language_code'],
			self::$authenticated ? null : self::$config['access_point_guid'], // WTF
			0,
			count($expected)
		);

		$this->assertSuccess($serviceResult);

		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(count($expected), $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

 	public function testGetByFolderID()
 	{
 		$serviceResult = self::$client->Object()->GetByFolderID(
			self::$data['folder'][1]['id'],
			false,
			self::$authenticated ? null : self::$config['access_point_guid'], // WTF
 			0,
 			$pageSize = 5
 		);

 		$this->assertSuccess($serviceResult);

		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
 		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
 	}
}
?>
