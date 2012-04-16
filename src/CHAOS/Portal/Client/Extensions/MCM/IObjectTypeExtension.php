<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to retrieve and manipulate object types.
	 */
	interface IObjectTypeExtension
	{
		/**
		 * @param string $name
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($name);

		/**
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get();

		/**
		 * @param int $id
		 * @param string $newName
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update($id, $newName);

		/**
		 * @param int $id
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($id);
	}
?>
