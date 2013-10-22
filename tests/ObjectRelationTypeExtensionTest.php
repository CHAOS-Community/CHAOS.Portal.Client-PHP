<?php
require_once 'PortalClientTestCase.php';

class ObjectRelationTypeExtensionTest extends PortalClientTestCase
{
	public function testGet()
	{
		$expected = self::$data['object_relation_type'][0];

		$serviceResult = self::$client->ObjectRelationType()->Get(
			$expected['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(1, $serviceResult->MCM()->Count(), "Returned correct number of objects");

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($expected['name'], $actual->Name, "Returned correct object");
	}
}
?>