<?php
require_once 'PortalClientTestCase.php';

class MetadataSchemaExtensionTest extends PortalClientTestCase
{
	public function testGet()
	{
		$expected = self::$data['metadata_schemas'][1];
		$serviceResult = self::$client->MetadataSchema()->Get(
			$expected['guid']
		);

		$this->assertTrue($serviceResult->WasSuccess(), 'ServiceResult was success');
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($expected['name'], $actual->Name, 'Schema name matches');
	}
}
?>