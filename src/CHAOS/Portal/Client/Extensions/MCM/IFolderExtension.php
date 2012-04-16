<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to retrieve and manipulate folders
	 */
	interface IFolderExtension
	{
		/**
		 * @param string $subscriptionGUID
		 * @param string $title
		 * @param int $parentID
		 * @param int $folderTypeID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($subscriptionGUID, $title, $parentID, $folderTypeID);

		/**
		 * @param int $id The ID of the folder to retrieve
		 * @param int $folderTypeID The ID of the foldertype to retrieve
		 * @param int $parentID The ID of the parent of the folders to retrieve
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($id, $folderTypeID, $parentID);

		/**
		 * @param int $id
		 * @param string $newTitle
		 * @param int $newFolderTypeID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update($id, $newTitle, $newFolderTypeID);

		/**
		 * @param int $id
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($id);
	}
?>