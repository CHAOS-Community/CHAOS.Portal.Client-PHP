<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to search for and manipulate Object Links.
	 */
	interface ILinkExtension
	{
		/**
		 * @param string $objectGUID
		 * @param int $folderID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($objectGUID, $folderID);

		/**
		 * @param string $objectGUID
		 * @param int $folderID
		 * @param int $newFolderID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update($objectGUID, $folderID, $newFolderID);

		/**
		 * @param string $objectGUID
		 * @param int $folderID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($objectGUID, $folderID);
	}
?>