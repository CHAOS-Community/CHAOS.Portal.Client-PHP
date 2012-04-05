<?php
	namespace CHAOS\Portal\Client;

	/**
	 * Extension use an IServiceCaller to call a service.
	 */
	interface IServiceCaller
	{
		const POST = "post";
		const GET = "get";


		/**
		 * @abstract
		 * @param $path
		 * @param $method
		 * @param array $parameters
		 * @param $requiresSession
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function CallService($path, $method, array $parameters, $requiresSession);
	}
?>