<?php
require_once 'PortalClientSetup.php';

use CHAOS\Portal\Client\PortalClient;

class PortalClientTest extends PHPUnit_Framework_TestCase
{
	protected static $servicePath;
	protected static $clientGUID;
	protected static $accessPointGUID;

	protected static $client;

	public static function setUpBeforeClass()
	{
		self::$servicePath = "http://api.chaos-systems.com/";
		self::$clientGUID = "B9CBFFDD-3F73-48FC-9D5D-3802FBAD4CBD";
		self::$accessPointGUID = "7A06C4FF-D15A-48D9-A908-088F9796AF28";
		self::$client = new PortalClient(self::$servicePath, self::$clientGUID);
	}

	public static function tearDownBeforeClass()
	{
		self::$client = NULL;
	}

	public function testSessionGUID()
	{
		$this->assertNotNull(self::$client->SessionGUID(), "SessionGUID was set");
	}

    /**
     * Asserts successfull ServiceResult
     *
     * @param  \CHAOS\Portal\Client\Data\ServiceResult $serviceResult
     * @throws PHPUnit_Framework_AssertionFailedError
     */
	public static function assertSuccess($serviceResult, $message = 'Successfully recieved ServiceResult')
	{
		try
		{
			self::assertTrue($serviceResult->WasSuccess(), $message);
			self::assertTrue($serviceResult->MCM()->WasSuccess(), $message);

		}
		catch (Exception $e)
		{
			$e_msg = $e->getMessage() . "\n\n";

			if (!$serviceResult->WasSuccess()) {
				$e_msg .= "Portal error: " . $serviceResult->Error()->Message() . "\n";
			} else if (!$serviceResult->MCM()->WasSuccess()) {
				$error = $serviceResult->MCM()->Error();

				$e_msg .= "Exception: " . $error->Name() . "\n";
				$e_msg .= "Message: " . $error->Message() . "\n";
				$e_msg .= "Stacktrace: " . $error->Stacktrace() . "\n";
			}

			throw new PHPUnit_Framework_AssertionFailedError($e_msg);
		}
	}
}
?>