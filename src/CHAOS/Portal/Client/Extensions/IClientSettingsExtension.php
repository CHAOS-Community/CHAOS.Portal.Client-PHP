<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to handle client settings
	 */
	interface IClientSettingsExtension
	{
		/**
		 * @param string|null $guid
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($guid = null);
	}
?>