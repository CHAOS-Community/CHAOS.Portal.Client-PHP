<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;
	use \CHAOS\Portal\Client\IPortalClient;

	class UserSettingsExtension extends AExtension implements IUserSettingsExtension
	{
		private $_clientGUID = null;

		function __construct(IServiceCaller $serviceCaller, IPortalClient $portalClient)
		{
			parent::__construct($serviceCaller);
		}

		public function Get($clientGUID = null)
		{
			if(is_null($clientGUID))
				$clientGUID = $this->_clientGUID;

			return $this->CallService("Get", IServiceCaller::GET, array("clientGUID" => $clientGUID));
		}

		public function Set($settings, $clientGUID = null)
		{
			if(is_null($clientGUID))
				$clientGUID = $this->_clientGUID;

			return $this->CallService("Set", IServiceCaller::GET, array("settings" => $settings, "clientGUID" => $clientGUID));
		}

		public function Delete($clientGUID = null)
		{
			if(is_null($clientGUID))
				$clientGUID = $this->_clientGUID;

			return $this->CallService("Delete", IServiceCaller::GET, array("clientGUID" => $clientGUID));
		}
	}
?>