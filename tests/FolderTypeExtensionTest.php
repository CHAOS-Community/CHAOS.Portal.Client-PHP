<?php
require_once 'PortalClientTestCase.php';

class FolderTypeExtensionTest extends PortalClientTestCase
{
	public function testGet()
	{
		$serviceResult = self::$client->FolderType()->Get(
			self::$data['folder'][0]['folder_type_id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertSuccess($serviceResult->Portal());
	}
}
?>