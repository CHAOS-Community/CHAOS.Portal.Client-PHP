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
		public function Session();
		public function EmailPassword();

		public function Object();

		public function StatsObject();
	}
?>