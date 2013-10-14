<?php
require_once 'PortalClientTest.php';

class ObjectTest extends PortalClientTest
{
	public function testGetByObjectGUID()
	{
		$serviceResult = self::$client->Object()->GetByObjectGUID(
			"00000000-0000-0000-0000-00004e040016" // objectGUID
			, self::$accessPointGUID                     // accessPointGuid
			, true                                 // includeMetadata
			, true                                 // includeFiles
			, true                                 // includeObjectRelations
			, false                                // includeAccessPoints
		);
		$object = $serviceResult->MCM()->Results()[0];

		$this->assertSuccess($serviceResult);

		$this->assertNotNull($object, "Returned non-null object");
		$this->assertEquals($serviceResult->MCM()->Count(), 1, "Returned exactly one object");
	}
}
?>