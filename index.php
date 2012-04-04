<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	spl_autoload_extensions(".php");
	spl_autoload_register(); //Autoload used classes

	use CHAOS\Portal\Client\PortalClient;

	$url = "http://api.chaos-systems.com/";
	$clientGUID = "B9CBFFDD-3F73-48FC-9D5D-3802FBAD4CBD";
	$email = "***";
	$password = "***";
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
			$client = new PortalClient($url, $clientGUID);

			echo json_encode($client->GetCurrentSessionGUID()) . "\n\n";

			$result = $client->EmailPassword()->Login($email, $password)->Portal->Results;

			echo json_encode($result[0]);
		?>
	</body>
</html>