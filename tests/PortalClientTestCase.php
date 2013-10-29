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

	public static $config;
	public static $data;

    protected static $orphans;
    protected static $timeFormat;

	public static function setUpBeforeClass()
	{
		self::$config = $GLOBALS['CONFIG'];
		self::$data = $GLOBALS['DATA'];

        self::$orphans = "orphans.txt";
        self::$timeFormat = "d-m-y H:i:s";

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

	public static function tearDownAfterClass()
	{
		self::$client = null;
		self::$authenticated = null;
		self::$config = null;
		self::$data = null;
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
            self::assertTrue($result->WasSuccess() && is_null($result->Error()), $message);

		} catch (Exception $e)
		{
			$e_msg = $e->getMessage() . "\n\n";

			$error = $result->Error();

			$e_msg .= "Exception: " . $error->Name() . "\n";
			$e_msg .= "Message: " . $error->Message() . "\n";
			$e_msg .= "Stacktrace: \n" . $error->Stacktrace() . "\n";

			throw new PHPUnit_Framework_AssertionFailedError($e_msg);
		} finally
		{
			if ($result instanceof CHAOS\Portal\Client\Data\ServiceResult)
			{
				if (!is_null($result->MCM()))
				{
					self::assertSuccess($result->MCM());

				} elseif (!is_null($result->Portal()))
				{
					self::assertSuccess($result->Portal());
				}
			}
		}
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
    
    protected static function addOrphan($id)
    {
        file_put_contents(self::$orphans, date(self::$timeFormat) . ' - ' . $id . "\n", FILE_APPEND | LOCK_EX);
    }

    protected static function removeOrphan($id)
    {
        $arr = file(self::$orphans, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
       
        $arr = array_filter($arr, function($item) use($id) {
            return strpos($item, $id) === false;
        });

        file_put_contents(self::$orphans, join("\n", $arr));
    }
}
?>
