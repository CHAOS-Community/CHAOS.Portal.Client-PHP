<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions\Portal;

	/**
	 * Extension to work with the session for a client
	 */
	interface ISessionExtension
	{

		/**
		 * Creates a Session
		 * @return ServiceResult
		 */
		public function Create();
	}
?>