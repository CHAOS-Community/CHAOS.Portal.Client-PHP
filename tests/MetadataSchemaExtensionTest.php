<?php
require_once 'PortalClientTestCase.php';

class MetadataSchemaExtensionTest extends PortalClientTestCase
{
//  Can't run this test with 'manager' permissions
//	public function testCreate()
//	{
//		$expected = self::$data['tests']['metadata_schemas'][0];
//		$serviceResult = self::$client->MetadataSchema()->Create(
//			$expected['name'],
//			$expected['schema_xml']
//		);
//		
//		$this->assertSuccess($serviceResult);
//
//		$serviceResult = self::$client->MetadataSchema()->Get(
//			$expected['guid']
//		);
//
//		$this->assertSuccess($serviceResult);
//
//		$actual = $serviceResult->MCM()->Results()[0];
//
//		$this->assertEquals($expected['name'], $actual->Name, 'Schema name matches');
//		$this->assertEquals($expected['name'], $actual->Name, 'Schema name matches');
//	}

	public function testGet()
	{
		$expected = self::$data['metadata_schemas'][1];
		$serviceResult = self::$client->MetadataSchema()->Get(
			$expected['guid']
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($expected['name'], $actual->Name, 'Schema name matches');
	}
	
	public function testUpdate()
	{
		$serviceResult = self::$client->MetadataSchema()->Get(
			self::$data['metadata_schemas'][0]['guid']
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

//  Won't test this with test schema (see comment above, testCreate)
//	public function testDelete()
//	{
//	}
}
?>