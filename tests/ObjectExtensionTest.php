<?php
require_once 'PortalClientTestCase.php';

class ObjectExtensionTest extends PortalClientTestCase
{
	public function testGetByObjectGUID()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUID(
			self::$data['objects'][0]['guid'],
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
			, self::$data['metadatas'][0]['metadata_schema_guid']
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
			, array(self::$data['metadatas'][0]['metadata_schema_guid'],
			        self::$data['metadatas'][1]['metadata_schema_guid'],
			        self::$data['metadatas'][2]['metadata_schema_guid'])
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
			  self::$data['folders'][0]['id']
 			, false
 			, self::$accessPointGUID
 			, 0
 			, $pageSize = 2
 		);

 		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
 		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
 	}
}
?>
