<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class SessionExtension extends AExtension implements ISessionExtension
	{
		private $_protocolVersion;
		private $_callback;

		protected function GetExtensionPath() { return "Session"; }

		public function __construct(IServiceCaller $serviceCaller, $protocolVersion, $callback)
		{
			parent::__construct($serviceCaller);
			$this->_protocolVersion = $protocolVersion;
			$this->_callback = $callback;
		}

		public function Create()
		{
			$result = $this->CallService("Create", IServiceCaller::GET, array("protocolVersion" => $this->_protocolVersion), false);

			$this->_callback->__invoke($result);

			return $result;
		}
	}
?>