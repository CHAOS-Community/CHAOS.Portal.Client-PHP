<?php
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . "/../src");
require_once("CaseSensitiveAutoload.php");
spl_autoload_extensions(".php");
spl_autoload_register("CaseSensitiveAutoload");

use CHAOS\Portal\Client\PortalClient;

class PortalClientTestCase extends PHPUnit_Framework_TestCase
{
	protected static $client;
	protected static $authenticated;

	protected static $config;
	protected static $data;

	public static function setUpBeforeClass()
	{
		self::$config = $GLOBALS['CONFIG'];
		self::$data = $GLOBALS['DATA'];

		self::$client = new PortalClient(self::$config['service_path'], self::$config['client_guid']);

		self::$authenticated = false;
		if (isset(self::$config['email']) && isset(self::$config['password']))
		{
			$serviceResult = self::$client->EmailPassword()->Login(
				self::$config['email'],
				self::$config['password']
			);

			try
			{
				self::assertEmpty($serviceResult->EmailPassword()->Error(), "Logged in without errors");

			} catch (Exception $e)
			{
				$e_msg = "Login failed!\n\n";

				$error = $serviceResult->EmailPassword()->Error();

				$e_msg .= "Exception: " . $error->Name() . "\n";
				$e_msg .= "Message: " . $error->Message() . "\n";
				$e_msg .= "Stacktrace: \n" . $error->Stacktrace() . "\n";

				echo $e_msg;
				exit(1); // All tests are gonne fail anyways, so let's put it out of its missery.

			} finally {
				self::$authenticated = true;
			}
		}
	}

	public static function tearDownBeforeClass()
	{
		self::$client = NULL;
		self::$authenticated = NULL;
		self::$config = NULL;
		self::$data = NULL;
	}

    /**
     * Asserts successfull response
     *
     * @param  \CHAOS\Portal\Client\Data\ServiceResult|ModuleResult $result
     * @throws PHPUnit_Framework_AssertionFailedError
     */
	public static function assertSuccess($result, $message = 'Successfull response')
	{
		try
		{
			self::assertTrue($result->WasSuccess(), $message);

		} catch (Exception $e)
		{
			$e_msg = $e->getMessage() . "\n\n";

			$error = $result->Error();

			$e_msg .= "Exception: " . $error->Name() . "\n";
			$e_msg .= "Message: " . $error->Message() . "\n";
			$e_msg .= "Stacktrace: \n" . $error->Stacktrace() . "\n";

			throw new PHPUnit_Framework_AssertionFailedError($e_msg);
		}
	}

    /**
     * Asserts unsuccessfull response
     *
     * @param  \CHAOS\Portal\Client\Data\ServiceResult|ModuleResult $result
     * @throws PHPUnit_Framework_AssertionFailedError
     */
	public static function assertNotSuccess($result, $message = 'Unsuccessfully response')
	{
		self::assertFalse($result->WasSuccess(), $message);
	}

    /*
	 * Asserts correct ScalarResult
	 *
	 * @param  integer $expected
	 * @param  \CHAOS\Portal\Client\Data\ModuleResult $result
	 * @throws PHPUnit_Framework_AssertionFailedError
	 */
	public static function assertScalarResultEquals($expected, $result, $message = 'Returned ScalarResult 1')
	{
		self::assertEquals($expected, $result->MCM()->Results()[0]->Value, $message);
	}
}
?>
