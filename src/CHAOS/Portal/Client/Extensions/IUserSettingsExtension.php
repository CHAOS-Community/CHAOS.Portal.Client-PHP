<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to handle user settings
	 */
	interface IUserSettingsExtension
	{
		/**
		 * @param string|null $guid
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($clientGUID = null);

		/**
		 * @param string $settings
		 * @param string|null $clientGUID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Set($settings, $clientGUID = null);

		/**
		 * @param string|null $clientGUID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($clientGUID = null);
	}
?>