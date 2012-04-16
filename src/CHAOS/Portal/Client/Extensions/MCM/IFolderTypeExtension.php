<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to create and delete folder types.
	 */
	interface IFolderTypeExtension
	{
		/**
		 * @param int|null $id
		 * @param string|null $name
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($id = null, $name = null);
	}
?>
