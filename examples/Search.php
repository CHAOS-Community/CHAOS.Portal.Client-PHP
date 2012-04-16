<?php
	spl_autoload_extensions(".php");
	spl_autoload_register(); //Autoload used classes

	use CHAOS\Portal\Client\PortalClient;

	$clientGUID = "B9CBFFDD-3F73-48FC-9D5D-3802FBAD4CBD"; //Client GUID should be unique for each application, any GIUD can be used.
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>CHAOS.Portal.Client Search Example</title>
	</head>
	<body>
		<h1>CHAOS.Portal.Client Search Example</h1>
		<?php
			if(isset($_POST["url"]) && isset($_POST["email"]) && isset($_POST["password"]))
			{
				$client = new PortalClient($_POST["url"], $clientGUID); //Create a new client, a session is automaticly created.

				echo "SessionGUID: " . $client->GetCurrentSessionGUID() . "<br />";

				$user = $client->EmailPassword()->Login($_POST["email"], $_POST["password"])->EmailPassword()->Results(); //Login using email/password combination.

				echo "UserGUID: " . $user[0]->GUID . "<br />";

				$schemas = $client->MetadataSchema()->Get()->MCM()->Results(); //To keep it short there's no error checking in this example.
				
				$schemaGUIDs = array();
				
				foreach($schemas as $schema)
				{
					$schemaGUIDs[] = $schema->GUID;
					
					if(count($schemaGUIDs) == 10) //Limit our search to the first 10 schemas available on the service.
						break;
				}

				$objects = $client->Object()->GetSearchSchemas("test", $schemaGUIDs, "da", 0, 10, true)->MCM()->Results(); //Login using email/password combination.
				
				echo "First 10 objects that matches &quot;test&quot; in the metadata in Danish:<br />";

				foreach($objects as $object)
				{
					echo "<p>" . htmlspecialchars(json_encode($object)) . "</p>";
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
				<input type="submit"/>
			</div>
		</form>
		<?php } ?>
	</body>
</html>