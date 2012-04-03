<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions\Portal;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class SessionExtension extends AExtension implements ISessionExtension
	{
		private $_protocolVersion;
		private $_callback;

		protected function GetExtensionPath() { return "Session"; }

		function __construct(IServiceCaller $serviceCaller, $protocolVersion, $callback)
		{
			parent::__construct($serviceCaller);
			$this->_protocolVersion = $protocolVersion;
			$this->_callback = $callback;
		}

		function Create()
		{
			$result = $this->CallService("Create", IServiceCaller::GET, array("ProtocolVersion" => $this->_protocolVersion), false);

			$this->_callback($result->Data);

			return $result;
		}
	}
?>