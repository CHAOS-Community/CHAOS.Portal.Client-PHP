<?php
	namespace CHAOS\Portal\Client\Extensions\EmailPassword;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class EmailPasswordExtension extends AExtension implements IEMailPasswordExtension
	{
		public function Login($email, $password)
		{
			return $this->CallService("Login", IServiceCaller::GET, array("email" => $email, "password" => $password));
		}

		public function ChangePasswordRequest($userGUID, $password, $url)
		{
			return $this->CallService("CreatePassword", IServiceCaller::GET, array("userGUID" => $userGUID, "password" => $password, "url" => $url));
		}
	}
?>