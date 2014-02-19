<?php
require_once 'PortalClientTestCase.php';

class FolderTypeExtensionTest extends PortalClientTestCase
{
	public function testGet()
	{
		$expected = self::$data['folder_type'][0];

		$serviceResult = self::$client->FolderType()->Get(
			$expected['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), "Returned not empty results");

		$actual = $serviceResult->MCM()->Results()[0];
		$this->assertEquals($expected['name'], $actual->Name, 'Result has correct name');
		$this->assertEquals($expected['date_created'], $actual->DateCreated, 'Result has correct date_created');
	}
}
?>