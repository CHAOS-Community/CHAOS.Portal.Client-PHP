<?php
require_once 'PortalClientTestCase.php';

class ObjectTypeExtensionTest extends PortalClientTestCase
{
	public function testCreate()
	{
		$this->markTestIncomplete(
            'Not implemented due to insufficient permissions.'
		);
	}

	public function testGet()
	{
		$expected = self::$data['object_type'][0];

		$serviceResult = self::$client->ObjectType()->Get();

		$this->assertSuccess($serviceResult);

		$needle = (object) array(
			'ID' => $expected['id'],
			'Name' => $expected['name'],
			'FullName' => $expected['full_name']
		);
		$this->assertContains(
			$needle,
			$serviceResult->MCM()->Results(),
			'Contains basic ObjectType',
			true,
			false
		);
	}

//  TODO: Change test object to one self created when sufficient permissions are aquired
	public function testUpdate()
	{
		$serviceResult = self::$client->ObjectType()->Get();

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$expected = $serviceResult->MCM()->Results()[0];

		$serviceResult = self::$client->ObjectType()->Update(
			$expected->ID,
			$expected->Name
		);

		$this->assertSuccess($serviceResult);

		$serviceResult = self::$client->ObjectType()->Get();

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];

		$this->assertEquals($expected->ID, $actual->ID, 'ID matches');
		$this->assertEquals($expected->Name, $actual->Name, 'Name matches');
	}

//  TODO: Implement
	public function testDelete()
	{
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}
}
?>