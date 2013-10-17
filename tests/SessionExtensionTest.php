<?php
require_once 'PortalClientTestCase.php';

class SessionExtensionTest extends PortalClientTestCase
{
//  Doesn't really test anything, as SessionGUID is never null
//	public function testCreate()
//	{
//		$serviceResult = self::$client->Session()->Create();
//
//		$this->assertNotNull($serviceResult, 'ServiceResult not null');
//		$this->assertTrue($serviceResult->WasSuccess(), 'ServiceResult was success');
//		$this->assertNotNull(self::$client->SessionGUID(), 'SessionGUID not null');
//	}

//  Can't be tested properly as is taken 30 min for SessionGUID to become invalid.
//	public function testUpdate()
//	{
//		$serviceResult = self::$client->Session()->Update();
//
//		$this->assertNotNull($serviceResult, 'ServiceResult not null');
//		$this->assertTrue($serviceResult->WasSuccess(), 'ServiceResult was success');
//	}

//	public function testDelete()
//	{
//// Before
//		$serviceResult = self::$client->Folder()->Get(
//			self::$data['folders'][0]['id']
//		);
//		var_dump($serviceResult);
//		$this->assertTrue($serviceResult->WasSuccess(), 'ServiceResult was success');
//		$this->assertNotEmpty($serviceResult->MCM()->Results(), 'Results not empty');
//
//// Delete
//		$serviceResult = self::$client->Session()->Delete();
//		$this->assertTrue($serviceResult->WasSuccess(), 'ServiceResult was success');
//
//// After
//		$serviceResult = self::$client->Folder()->Get(
//			self::$data['folders'][0]['id']
//		);
//		var_dump($serviceResult);
//		$this->assertTrue($serviceResult->WasSuccess(), 'ServiceResult was success');
//		$this->assertEmpty($serviceResult->MCM()->Results(), 'Results empty');
//	}
}
?>