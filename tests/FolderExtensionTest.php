<?php
require_once 'PortalClientTestCase.php';

class FolderExtensionTest extends PortalClientTestCase
{
	public function testCreate()
	{
		$serviceResult = self::$client->Folder()->Create(
			null,
            'Test',
            '1',
            self::$data['folder'][0]['id']
		);

		$this->assertSuccess($serviceResult);

        $actual = null;
        try
        {
            $this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results contains the one just created');
            $actual = $serviceResult->MCM()->Results()[0];

        } finally
        {
            self::addOrphan('Folder ID:' . $actual->ID);
        }

        return $actual;
    }

    /**
     * @depends testCreate
     */
    public function testGet($folder)
    {
        sleep(10); // Sorry

        $serviceResult = self::$client->Folder()->Get(
            $folder->ID
		);

        $this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($folder->ID, $actual->ID, 'Returned correct id');
        $this->assertEquals($folder->Name, $actual->Name, 'Returned correct name');
	}

    /**
     * @depends testCreate
     */
    public function testUpdate($folder)
	{
		$serviceResult = self::$client->Folder()->Update(
			$folder->ID,
			$newName = 'Test test',
			$newType = '2'
		);

		$this->assertSuccess($serviceResult);
		$this->assertScalarResultEquals(1, $serviceResult);

		$serviceResult = self::$client->Folder()->Get(
			$folder->ID
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($folder->ID, $actual->ID, 'Returned correct ID');
		$this->assertEquals($newName, $actual->Name, 'Returned correct Name');
	}

    /**
     * @depends testCreate
     */
	public function testDelete($folder)
	{
		$serviceResult = self::$client->Folder()->Delete(
			$folder->ID
		);

        $this->assertSuccess($serviceResult);

        try
        {
            $this->assertScalarResultEquals(1, $serviceResult);
        } finally
        {
            self::removeOrphan('Folder ID:' . $folder->ID);
        }

		$serviceResult = self::$client->Folder()->Get(
			$folder->ID
		);

		$this->assertSuccess($serviceResult);
        $this->assertEmpty($serviceResult->MCM()->Results(), 'Result does not contain the one just deleted');
    }

	public function testGetPermission()
	{
		$expected = self::$data['folder'][0];

		$serviceResult = self::$client->Folder()->GetPermission(
			$expected['id']
		);

		$this->assertSuccess($serviceResult);
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
		$this->assertScalarResultEquals(1, $serviceResult);

		$serviceResult = self::$client->Folder()->GetPermission(
			$folder['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

		$needle = (object) array( 'Name' => ucfirst($expected), 'Value' => self::$data['folder_permission'][$expected] );
		$this->assertContains(
			$needle,
			$serviceResult->MCM()->Results()[0]->PermissionDetails,
			'Results contains the set permission',
			false,
			false
		);
	}
}
?>