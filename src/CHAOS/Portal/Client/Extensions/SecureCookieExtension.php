<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class SecureCookieExtension extends AExtension implements ISecureCookieExtension 
	{
		public function Create()
		{
			return $this->CallService("Create", IServiceCaller::GET);
		}

		public function Delete(array $guids)
		{
			throw new \Exception("Method not implemented");
		}

		public function Login($guid, $passwordGUID)
		{
			return $this->CallService("Create", IServiceCaller::GET, array("guid" => $guid,
				"passwordGUID" => $passwordGUID));
		}
	}
?>