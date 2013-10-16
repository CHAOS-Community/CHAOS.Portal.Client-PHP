<?php
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . "/../src");
require_once("CaseSensitiveAutoload.php");
spl_autoload_extensions(".php");
spl_autoload_register("CaseSensitiveAutoload");

use CHAOS\Portal\Client\PortalClient;

class PortalClientTestCase extends PHPUnit_Framework_TestCase
{
	protected static $servicePath;
	protected static $clientGUID;
	protected static $accessPointGUID;

	protected static $client;

	protected static $config;
	protected static $data;

	public static function setUpBeforeClass()
	{
		self::$config = $GLOBALS['CONFIG'];
		self::$data = $GLOBALS['DATA'];

		self::$servicePath = self::$config['service_path'];
		self::$clientGUID = self::$config['client_guid'];
		self::$accessPointGUID = self::$config['access_point_guid'];

		self::$client = new PortalClient(self::$servicePath, self::$clientGUID);

		if (isset(self::$config['email']) && isset(self::$config['password']))
		{
			self::$client->EmailPassword()->Login(self::$config['email'],
			                                      self::$config['password']);
		}
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
				$e_msg .= "Stacktrace: \n" . $error->Stacktrace() . "\n";
			}

			throw new PHPUnit_Framework_AssertionFailedError($e_msg);
		}
	}
}
?>
