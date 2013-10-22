<?php
require_once 'PortalClientTestCase.php';

class MetadataExtensionTest extends PortalClientTestCase
{
	public function testGet()
	{
		$this->markTestIncomplete(
			'Method not implemented in API.'
		);

		$serviceResult = self::$client->Metadata()->Get(
			self::$data['metadata'][0]['guid']
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');
//      TODO: Add more assertions when methods gets implemented in API
	}
}
?>