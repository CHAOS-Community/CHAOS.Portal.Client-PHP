<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client;

	/**
	 * Extension use an IServiceCaller to call a service.
	 */
	interface IServiceCaller
	{
		const POST = "post";
		const GET = "get";

		function CallService($path, $method, array $parameters, $requiresSession);
	}
?>