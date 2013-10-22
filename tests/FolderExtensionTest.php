<?php
require_once 'PortalClientTestCase.php';

class FolderExtensionTest extends PortalClientTestCase
{
	public function testCreate()
	{
//		Let's not create more duds than necessary
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);

		$expected = self::$data['folder'][0];

		$serviceResult = self::$client->Folder()->Create(
			null,
			$expected['name'],
			$expected['folder_type_id'],
			self::$data['folder'][1]['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');
	}

	public function testGet()
	{
		$expected = self::$data['folder'][1];

		$serviceResult = self::$client->Folder()->Get(
			$expected['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($expected['id'], $actual->ID, 'Returned correct id');
		$this->assertEquals($expected['name'], $actual->Name, 'Returned correct name');
	}

	public function testUpdate()
	{
		$expected = self::$data['folder'][0];

		$serviceResult = self::$client->Folder()->Update(
			$expected['id'],
			'mobydick',
			'2'
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertScalarResultEquals(1, $serviceResult);

		$serviceResult = self::$client->Folder()->Get(
			$expected['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($expected['id'], $actual->ID, 'Returned correct id');
		$this->assertEquals('mobydick', $actual->Name, 'Returned correct name');
		$this->assertEquals('2', $actual->FolderTypeID, 'Returned correct folder_type_id');

		$serviceResult = self::$client->Folder()->Update(
			$expected['id'],
			$expected['name'],
			$expected['folder_type_id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertScalarResultEquals(1, $serviceResult);
	}

	public function testDelete()
	{
		$expected = self::$data['folder'][0];

		$serviceResult = self::$client->Folder()->Delete(
			$expected['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->Portal());

		$serviceResult = self::$client->Folder()->Get(
			$expected['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertEmpty($serviceResult->MCM()->Results(), 'Result does not contain the one just deleted');
	}

	public function testGetPermission()
	{
		$expected = self::$data['folder'][0];

		$serviceResult = self::$client->Folder()->GetPermission(
			$expected['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$needle = (object) array( 'Name' => "Read", 'Value' => self::$data['folder_permission']['read'] );
		$this->assertContains(
			$needle,
			$serviceResult->MCM()->Results()[0]->PermissionDetails,
			'Results contains basic permission',
			FALSE,
			FALSE
		);
	}

	public function testSetPermission()
	{
		$folder = self::$data['folder'][0];
		$expected = 'delete';

		$serviceResult = self::$client->Folder()->SetPermission(
			$folder['id'],
			self::$data['folder_permission'][$expected],
			self::$config['user_guid']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertScalarResultEquals(1, $serviceResult);

		$serviceResult = self::$client->Folder()->GetPermission(
			$folder['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->MCM());
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$needle = (object) array( 'Name' => ucfirst($expected), 'Value' => self::$data['folder_permission'][$expected] );
		$this->assertContains(
			$needle,
			$serviceResult->MCM()->Results()[0]->PermissionDetails,
			'Results contains the set permission',
			FALSE,
			FALSE
		);
	}
}
?>