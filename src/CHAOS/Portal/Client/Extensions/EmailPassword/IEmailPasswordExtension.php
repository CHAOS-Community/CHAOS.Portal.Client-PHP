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
		 * @param $url string The URL the user is redirected two from a link sent to the users email.
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function ChangePasswordRequest($userGUID, $password, $url);

		/**
		 * @param $email string
		 * @param $password string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Login($email, $password);
	}
?>