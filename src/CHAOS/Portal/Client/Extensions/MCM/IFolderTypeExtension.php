<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to create and delete folder types.
	 */
	interface IFolderTypeExtension
	{
		/**
		 * @param $id int|null
		 * @param $name string|null
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($id = null, $name = null);
	}
?>
