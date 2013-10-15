<?php
require_once 'PortalClientTest.php';

class ObjectExtensionTest extends PortalClientTest
{
	public function testGetByObjectGUID()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUID(
			"00000000-0000-0000-0000-00004e040016"
			, self::$accessPointGUID

		);

		$this->assertSuccess($serviceResult);

		$object = $serviceResult->MCM()->Results()[0];

		$this->assertNotNull($object, "Returned non-null object");
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

		$object = $serviceResult->MCM()->Results()[0];

		$this->assertNotNull($object, "Returned non-null object");
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
			, 1
		);

		$this->assertSuccess($serviceResult);

		$object = $serviceResult->MCM()->Results()[0];

		$this->assertNotNull($object, "Returned non-null object");
		$this->assertEquals(1, $serviceResult->MCM()->Count(), "Returned correct number of objects");
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
			, 3

		);

		$this->assertSuccess($serviceResult);

		$object = $serviceResult->MCM()->Results()[0];

		$this->assertNotNull($object, "Returned non-null object");
		$this->assertEquals(3, $serviceResult->MCM()->Count(), "Returned correct number of objects");
	}

 	public function testGetByFolderID()
 	{
 		$serviceResult = self::$client->Object()->GetByFolderID(
 			"444"
 			, false
 			, self::$accessPointGUID
 			, 0
 			, 6
 		);

 		$this->assertSuccess($serviceResult);

 		$object = $serviceResult->MCM()->Results()[0];

 		$this->assertNotNull($object, "Returned non-null object");
 		$this->assertEquals(6, $serviceResult->MCM()->Count(), "Returned correct number of objects");
 	}
}
?>
