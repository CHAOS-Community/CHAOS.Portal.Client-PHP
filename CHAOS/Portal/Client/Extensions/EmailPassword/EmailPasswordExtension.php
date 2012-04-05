<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions\EmailPassword;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class EmailPasswordExtension extends AExtension implements IEMailPasswordExtension
	{
		public function Login($email, $password)
		{
			return $this->CallService("Login", IServiceCaller::GET, array("email" => $email, "password" => $password));
		}

		public function CreatePassword($userGUID, $password)
		{
			return $this->CallService("CreatePassword", IServiceCaller::GET, array("userGUID" => $userGUID, "password" => $password));
		}
	}
?>