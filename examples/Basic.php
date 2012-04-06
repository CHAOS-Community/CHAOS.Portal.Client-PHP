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
		<title>CHAOS.Portal.Client Example</title>
	</head>
	<body>
		<h1>CHAOS.Portal.Client Example</h1>
		<?php
			if(isset($_POST["url"]) && isset($_POST["email"]) && isset($_POST["password"]))
			{
				$client = new PortalClient($_POST["url"], $clientGUID); //Create a new client, a session is automaticly created.

				echo "SessionGUID: " . $client->GetCurrentSessionGUID() . "<br />";

				$user = $client->EmailPassword()->Login($_POST["email"], $_POST["password"])->EmailPassword()->Results(); //Login using email/password combination.

				echo "UserGUID: " . $user[0]->GUID . "<br />";

				$objectResult = $client->Object()->GetByFolderID(212, true, true, false, false, 0, 3); //Get three objects with metadata from folder with ID 212.

				echo "First three Objects in folder 212: <br />";

				if($objectResult->WasSuccess() && $objectResult->MCM()->WasSuccess()) //If the service call was successful and the module processed the call successfully.
				{
					$objects = $objectResult->MCM()->Results(); //Get the objects from the MCM module

					foreach($objects as $object) //Loop through the returned objects
					{
						echo "<p>" . htmlspecialchars(json_encode($object)) . "</p>";
					}
				}
				else
				{
					$error = $objectResult->WasSuccess() ? $objectResult->MCM()->Error() : $objectResult->Error(); //If there was an error, print it out.

					echo "Object/Get failed with error: " . $error->Message() . "<br />";
				}

				$folderResult = $client->Folder()->Get(null, null, null); //Get the top folders

				echo "Top folders: <br />";

				$folders = $folderResult->MCM()->Results(); //Get the folder returned from the MCM module

				foreach($folders as $folder) //Loop through the returned the folders
				{
					echo "<p>" . htmlspecialchars(json_encode($folder)) . "</p>";
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