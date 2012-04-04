<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	spl_autoload_extensions(".php");
	spl_autoload_register(); //Autoload used classes

	use CHAOS\Portal\Client\PortalClient;

	$clientGUID = "B9CBFFDD-3F73-48FC-9D5D-3802FBAD4CBD";
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
				$client = new PortalClient($_POST["url"], $clientGUID);

				echo "SessionGUID: " . $client->GetCurrentSessionGUID() . "<br />";

				$user = $client->EmailPassword()->Login($_POST["email"], $_POST["password"])->EmailPassword()->Results();

				echo "UserGUID: " . $user[0]->GUID . "<br />";

				$objectResult = $client->Object()->Get("test", null, true, false, false, 0, 10);

				if($objectResult->WasSuccess())
				{
					$objects = $objectResult->Results();

					foreach($objects as $object)
					{
						echo json_encode($object) . "<br />";
					}
				}
				else
					echo "Object/Get failed<br />";
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