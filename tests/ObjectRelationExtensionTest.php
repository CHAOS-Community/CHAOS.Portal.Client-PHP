<?php
require_once 'PortalClientTestCase.php';

class ObjectRelationExtensionTest extends PortalClientTestCase
{
	public function testCreate()
	{
		$relation = (object) array(
			'From' => self::$data['object'][0]['guid'],
			'To' => self::$data['object'][1]['guid'],
			'Type' => self::$data['object_relation_type'][0]['id']
		);
		$serviceResult = self::$client->ObjectRelation()->Create(
			$relation->From,
			$relation->To,
			$relation->Type
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Results not empty");
		$this->assertScalarResultEquals(1, $serviceResult);

		return $relation;
	}

    /**
	 * @depends testCreate
	 */
	public function testDelete($relation)
	{
		$serviceResult = self::$client->ObjectRelation()->Delete(
			$relation->From,
			$relation->To,
			$relation->Type
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");
		$this->assertScalarResultEquals(1, $serviceResult);
	}
}
?>