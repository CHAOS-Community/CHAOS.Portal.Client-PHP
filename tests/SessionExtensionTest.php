<?php
require_once 'PortalClientTestCase.php';

class SessionExtensionTest extends PortalClientTestCase
{
	public function testCreate()
	{
		$this->markTestIncomplete(
			"Doesn't really test anything, as SessionGUID is never null"
		);

		$serviceResult = self::$client->Session()->Create();

		$this->assertSuccess($serviceResult);
		$this->assertNotNull(self::$client->SessionGUID(), 'SessionGUID not null');
	}

	public function testUpdate()
	{
		$this->markTestIncomplete(
			"Can't be tested properly with unit tests as is taken 30 min for SessionGUID to become invalid"
		);

		$serviceResult = self::$client->Session()->Update();

		$this->assertSuccess($serviceResult);
	}

	public function testDelete()
	{
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);

//      Before
		$serviceResult = self::$client->Folder()->Get(
			self::$data['folders'][0]['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');

//      Delete
		$serviceResult = self::$client->Session()->Delete();
		$this->assertSuccess($serviceResult);

//      After
		$serviceResult = self::$client->Folder()->Get(
			self::$data['folders'][0]['id']
		);

		$this->assertSuccess($serviceResult);
		$this->assertEmpty($serviceResult->MCM()->Results(), 'Results empty');
	}
}
?>