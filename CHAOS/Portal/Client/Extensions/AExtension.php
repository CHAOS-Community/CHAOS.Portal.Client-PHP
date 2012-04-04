<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	abstract class AExtension
	{
		private $_serviceCaller;

		abstract protected function GetExtensionPath();

		function __construct(IServiceCaller $serviceCaller)
		{
			$this->_serviceCaller = $serviceCaller;
		}

		protected function CallService($extensionMethod, $httpMethod, array $parameters, $requiresSession = true)
		{
			return $this->_serviceCaller->CallService($this->GetExtensionPath() . "/" . $extensionMethod, $httpMethod, $parameters, $requiresSession);
		}
	}
?>