<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to log in as user with email/password combination
	 */
	interface IEmailPasswordExtension
	{
		/**
		 * @param string $userGUID
		 * @param string $password
		 * @param string $url The URL the user is redirected two from a link sent to the users email.
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function ChangePasswordRequest($userGUID, $password, $url);

		/**
		 * @param string $email
		 * @param string $password
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Login($email, $password);
	}
?>