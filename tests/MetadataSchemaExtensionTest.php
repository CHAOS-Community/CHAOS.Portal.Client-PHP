<?php
require_once 'PortalClientTestCase.php';

class MetadataSchemaExtensionTest extends PortalClientTestCase
{
	public function testCreate()
	{
		$this->markTestIncomplete(
            'Not implemented due to insufficient permissions.'
		);

		$expected = self::$data['metadata_schema'][3];

		$serviceResult = self::$client->MetadataSchema()->Create(
			$expected['name'],
			$expected['schema_xml']
		);

		$this->assertSuccess($serviceResult);

		$serviceResult = self::$client->MetadataSchema()->Get(
			$expected['guid']
		);

		$this->assertSuccess($serviceResult);

		$actual = $serviceResult->MCM()->Results()[0];

		$this->assertEquals($expected['name'], $actual->Name, 'Schema name matches');
		$this->assertEquals($expected['schema_xml'], $actual->SchemaXML, 'Schema xml matches');
	}

	public function testGet()
	{
		$expected = self::$data['metadata_schema'][1];
		$serviceResult = self::$client->MetadataSchema()->Get(
			$expected['guid']
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($expected['name'], $actual->Name, 'Schema name matches');
	}

//  TODO: Replace test object with the one created when sufficient permissions are aquired
	public function testUpdate()
	{
		$serviceResult = self::$client->MetadataSchema()->Get(
			self::$data['metadata_schema'][0]['guid']
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$expected = $serviceResult->MCM()->Results()[0];

		$serviceResult = self::$client->MetadataSchema()->Update(
			$expected->Name,
			$expected->SchemaXML,
			$expected->GUID
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$serviceResult = self::$client->MetadataSchema()->Get(
			$expected->GUID
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];

		$this->assertEquals($expected->GUID, $actual->GUID, 'Schema GUID matches');
		$this->assertEquals($expected->Name, $actual->Name, 'Schema name matches');
		$this->assertEquals($expected->SchemaXML, $actual->SchemaXML, 'Schema schemaXML matches');
	}

	/**
	 * @depends testCreate
	 */
	public function testDelete($schema)
	{
		$serviceResult = self::$client->MetadataSchema()->Delete(
			$schema->GUID
		);

		$this->assertSuccess($serviceResult);

		$serviceResult = self::$client->MetadataSchema()->Get(
			$expected['guid']
		);

		$this->assertSuccess($serviceResult);
		$this->assertEmpty($serviceResult->MCM()->Results(), 'Results empty');
	}
}
?>