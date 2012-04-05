<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client;

	/**
	 * Allows easy communication with a Portal service
	 */
	interface IPortalClient
	{

		/**
		 * Sets a session GUID to use.
		 * @param $value string The GUID to use.
		 */
		public function SetCurrentSessionGUID($value);

		/**
		 * Returns the currently used session GUID.
		 * @return string
		 */
		public function GetCurrentSessionGUID();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\Portal\ISessionExtension
		 */
		public function Session();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\EmailPassword\IEmailPasswordExtension
		 */
		public function EmailPassword();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\IObjectExtension
		 */
		public function Object();
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\IFolderExtension
		 */
		public function Folder();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\Statistics\IStatsObjectExtension
		 */
		public function StatsObject();
	}
?>