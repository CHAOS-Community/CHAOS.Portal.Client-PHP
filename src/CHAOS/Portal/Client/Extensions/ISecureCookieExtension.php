<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to with SecureCookie for login.
	 */
	interface ISecureCookieExtension
	{
		/**
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create();

		/**
		 * @param array $guids
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete(array $guids);

		/**
		 * @param string $guid
		 * @param string $passwordGUID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Login($guid, $passwordGUID);
	}
?>
