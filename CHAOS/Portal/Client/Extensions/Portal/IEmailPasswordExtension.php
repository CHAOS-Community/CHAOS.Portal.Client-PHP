<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions\Portal;

	/**
	 * Extension to log in as user with email/password combination
	 */
	interface IEMailPasswordExtension
	{
		public function CreatePassword($userGUID, $password);

		public function Login($email, $password);
	}
?>