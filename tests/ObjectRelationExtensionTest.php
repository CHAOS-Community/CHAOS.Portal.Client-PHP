<?php
require_once 'PortalClientTestCase.php';

class ObjectRelationExtensionTest extends PortalClientTestCase
{
//	Permissions not yet implemented in CHAOS
//  Will fail when that happens
	public function testCreate()
	{
		$serviceResult = self::$client->ObjectRelation()->Create(
			self::$data['object'][0]['guid'],
			self::$data['object'][1]['guid'],
			self::$data['object_relation_type'][0]['id']
		);
		
		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(1, $serviceResult->MCM()->Results()[0]->Value, "Returned ScalarResult 1");
	}

//	Permissions not yet implemented in CHAOS
//  Will fail when that happens
	public function testDelete()
	{
		$serviceResult = self::$client->ObjectRelation()->Delete(
			self::$data['object'][0]['guid'],
			self::$data['object'][1]['guid'],
			self::$data['object_relation_type'][0]['id']
		);
		
		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertEquals(1, $serviceResult->MCM()->Results()[0]->Value, "Returned ScalarResult 1");
	}
}
?>