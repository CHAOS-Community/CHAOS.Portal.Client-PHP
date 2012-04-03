<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	spl_autoload_extensions(".php");
	spl_autoload_register(); //Autoload used classes

	use CHAOS\Portal\Client;

	$client = new PortalClient();
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

		?>
	</body>
</html>