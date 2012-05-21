<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
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
		<title>CHAOS.Portal.Client Basic Example</title>
	</head>
	<body>
		<h1>CHAOS.Portal.Client Basic Example</h1>
		<?php
			if(isset($_POST["url"]) && isset($_POST["email"]) && isset($_POST["password"]))
			{
				$client = new PortalClient($_POST["url"], $clientGUID); //Create a new client, a session is automaticly created.

				echo "SessionGUID: " . $client->SessionGUID() . "<br />";

				$user = $client->EmailPassword()->Login($_POST["email"], $_POST["password"])->EmailPassword()->Results(); //Login using email/password combination.

				echo "UserGUID: " . $user[0]->GUID . "<br />";

				echo "Top folders: <br />";

				$folderResult = $client->Folder()->Get(null, null, null); //Get the top folders
				
				$folders = $folderResult->MCM()->Results(); //Get the folder returned from the MCM module
				$folderID = null;

				foreach($folders as $folder) //Loop through the returned the folders
				{
					if(is_null($folderID))
						$folderID = $folder->ID;
					
					echo "<p>" . htmlspecialchars(json_encode($folder)) . "</p>";
				}
				
				if(is_null($folderID))
				{
					echo "<p>No folder found, so no objects retrieved.</p>";
				}
				else
				{
					$objectResult = $client->Object()->GetByFolderID($folderID, true, null, 0, 3, true, false, false); //Get three objects with metadata from folder with ID 212.

					echo "First three Objects in folder $folderID: <br />";

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