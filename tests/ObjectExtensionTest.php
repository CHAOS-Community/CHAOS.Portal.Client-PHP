<?php
require_once 'PortalClientTestCase.php';

class ObjectExtensionTest extends PortalClientTestCase
{
	public function testGetByObjectGUID()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUID(
			"00000000-0000-0000-0000-00004e040016"
			, self::$accessPointGUID
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(1, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetByObjectGUIDs()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUIDs(
			array("00000000-0000-0000-0000-00004e040016",
			      "00000000-0000-0000-0000-000064faff15")
			, self::$accessPointGUID
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(2, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

	public function testGetSearchSchema()
	{
		$serviceResult = self::$client->Object()->GetSearchSchema(
			"test"
			, "5906a41b-feae-48db-bfb7-714b3e105396"
			, "da"
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
			"test"
			, array("5906a41b-feae-48db-bfb7-714b3e105396",
			        "00000000-0000-0000-0000-000063c30000",
			        "00000000-0000-0000-0000-000065c30000")
			, "da"
			, self::$accessPointGUID
			, 0
			, $pageSize = 1
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals($pageSize, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

 	public function testGetByFolderID()
 	{
 		$serviceResult = self::$client->Object()->GetByFolderID(
 			"444"
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
