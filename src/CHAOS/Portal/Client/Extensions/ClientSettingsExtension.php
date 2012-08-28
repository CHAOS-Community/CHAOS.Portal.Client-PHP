<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;
	use \CHAOS\Portal\Client\IPortalClient;

	class ClientSettingsExtension extends AExtension implements IClientSettingsExtension
	{
		private $_clientGUID = null;

		function __construct(IServiceCaller $serviceCaller, IPortalClient $portalClient)
		{
			parent::__construct($serviceCaller);
		}

		public function Get($guid = null)
		{
			if(is_null($guid))
				$guid = $this->_clientGUID;

			return $this->CallService("Get", IServiceCaller::GET, array("guid" => $guid));
		}
	}
?>