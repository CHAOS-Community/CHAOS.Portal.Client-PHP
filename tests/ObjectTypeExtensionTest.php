<?php
require_once 'PortalClientTestCase.php';

class ObjectTypeExtensionTest extends PortalClientTestCase
{
//	Insufficient permissions
	public function testCreate() {}

	public function testGet()
	{
		$serviceResult = self::$client->ObjectType()->Get();

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');
	}

//	Insufficient permissions
	public function testUpdate()
	{
//		$serviceResult = self::$client->ObjectType()->Get();
//
//		$this->assertSuccess($serviceResult);
//		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');
//
//		$expected = $serviceResult->MCM()->Results()[0];
//
//		$serviceResult = self::$client->ObjectType()->Update(
//			$expected->ID,
//			$expected->Name
//		);
//
//		$this->assertSuccess($serviceResult);
//		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');
//
//		$serviceResult = self::$client->ObjectType()->Get();
//		
//		$this->assertSuccess($serviceResult);
//		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');
//		
//		$actual = $serviceResult->MCM()->Results()[0];
//		
//		$this->assertEquals($expected->ID, $actual->ID, 'ID matches');
//		$this->assertEquals($expected->Name, $actual->Name, 'Name matches');
	}

//	Insufficient permissions
	public function testDelete() {}
}
?>