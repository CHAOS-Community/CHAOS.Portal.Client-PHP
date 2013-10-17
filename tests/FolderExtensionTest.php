<?php
require_once 'PortalClientTestCase.php';

class FolderExtensionTest extends PortalClientTestCase
{
	public function testGet()
	{
		$serviceResult = self::$client->Folder()->Get(
			self::$data['folders'][0]['id']
		);

		$this->assertTrue($serviceResult->WasSuccess(), 'ServiceResult was success');
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');
	}
}
?>