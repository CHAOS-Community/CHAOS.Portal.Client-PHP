<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to work with the session for a client
	 */
	interface ISessionExtension
	{

		/**
		 * Creates a Session
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create();
	}
?>