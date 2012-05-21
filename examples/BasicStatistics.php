<?php
	set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . "/../src"); //Use this to set the path to the location of the CHAOS folder, this is where PHP will look for the PortalClient files.
	require_once("CaseSensitiveAutoload.php");

	spl_autoload_extensions(".php");
	spl_autoload_register("CaseSensitiveAutoload");

	use CHAOS\Portal\Client\PortalClient;

	$clientGUID = "B9CBFFDD-3F73-48FC-9D5D-3802FBAD4CBD"; //Client GUID should be unique for each application, any GIUD can be used.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>CHAOS.Portal.Client Basics Statistics Example</title>
	</head>
	<body>
		<h1>CHAOS.Portal.Client Basics Statistics Example</h1>
		<?php
			if(isset($_POST["url"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["repositoryName"]))
			{
				$client = new PortalClient($_POST["url"], $clientGUID); //Create a new client, a session is automaticly created.
		
				echo "SessionGUID: " . $client->SessionGUID() . "<br />";
		
				$user = $client->EmailPassword()->Login($_POST["email"], $_POST["password"])->EmailPassword()->Results(); //Login using email/password combination.
		
				echo "UserGUID: " . $user[0]->GUID . "<br />";
				
				//For the meaning of the hardcoded values in the StatsObject/Set call, please see the documentation for Portal/Statistics.
				$StatsResult = $client->StatsObject()->Set($_POST["repositoryName"], "TestObject1", 1, 1, "TestChannel1", 1, 1, "Test Object 1", $_SERVER['REMOTE_ADDR'], "Test City", "Test Country", 0);
				
				echo "Stats result:<br />";
				
				if($StatsResult->WasSuccess() && $StatsResult->Statistics()->WasSuccess())
				{
					echo json_encode($StatsResult->Statistics()->Results());
				}
				else
				{
					$error = $StatsResult->WasSuccess() ? $StatsResult->Statistics()->Error() : $StatsResult->Error(); //If there was an error, print it out.

					echo "Failed with error: " . $error->Message() . "<br />";
				}
		?>
		<?php
			} else {
		?>
			<form action="" method="post">
				<div>
					<p><label>URL: <input name="url" type="text" size="50" /></label></p>
					<p><label>Email: <input name="email" type="text" size="30" /></label></p>
					<p><label>Password: <input name="password" type="password" size="30"  /></label></p>
					<p><label>Repository name: <input name="repositoryName" type="text" size="30"  /></label></p>
					<input type="submit"/>
				</div>
			</form>
		<?php } ?>
	</body>
</html>