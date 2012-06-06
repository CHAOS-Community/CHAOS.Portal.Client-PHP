<?php
	namespace CHAOS\Portal\Client;

	/**
	 * Extension use an IServiceCaller to call a service.
	 */
	interface IServiceCaller
	{
		const POST = "post";
		const GET = "get";
		const DATE_FORMAT = "d-m-Y h:m:s";

		/**
		 * @param string $path
		 * @param string $method
		 * @param array|null $parameters
		 * @param bool $requiresSession
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function CallService($path, $method, array $parameters = null, $requiresSession = true);
	}
?>