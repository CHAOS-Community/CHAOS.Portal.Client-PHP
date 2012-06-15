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

		/**
		 * Updates a Session to keep it alive
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update();

		/**
		 * Deletes a Session, effectively logging off
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete();
	}
?>