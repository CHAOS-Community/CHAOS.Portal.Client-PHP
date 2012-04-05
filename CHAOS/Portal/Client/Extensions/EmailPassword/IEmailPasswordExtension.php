<?php
	namespace CHAOS\Portal\Client\Extensions\EmailPassword;

	/**
	 * Extension to log in as user with email/password combination
	 */
	interface IEMailPasswordExtension
	{
		/**
		 * @param $userGUID string
		 * @param $password string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function CreatePassword($userGUID, $password);

		/**
		 * @param $email string
		 * @param $password string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Login($email, $password);
	}
?>