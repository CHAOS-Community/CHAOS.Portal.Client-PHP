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

		function __construct(IServiceCaller $serviceCaller)
		{
			$this->_serviceCaller = $serviceCaller;
		}

		private function GetExtensionPath()
		{
			$className = get_class($this);
			return substr($className, strrpos($className, "\\") + 1, -9);
		}

		/**
		 * @param $extensionMethod
		 * @param $httpMethod
		 * @param array $parameters
		 * @param bool $requiresSession
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		protected function CallService($extensionMethod, $httpMethod, array $parameters, $requiresSession = true)
		{
			return $this->_serviceCaller->CallService($this->GetExtensionPath() . "/" . $extensionMethod, $httpMethod, $parameters, $requiresSession);
		}
	}
?>