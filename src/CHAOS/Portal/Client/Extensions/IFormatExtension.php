<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to retrieve and manipulate File Formats.
	 */
	interface IFormatExtension
	{
		/**
		 * @param string $name
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($name);
		
		/**
		 * @param int|null $id
		 * @param string|null $name
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($id, $name);

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
