<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to retrieve and manipulate folders
	 */
	interface IFolderExtension
	{
		/**
		 * @param string $subscriptionGUID
		 * @param string $title
		 * @param int $folderTypeID
		 * @param int|null $parentID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($subscriptionGUID, $title, $folderTypeID, $parentID = null);

		/**
		 * @param int|null $folderTypeID The ID of the foldertype to retrieve
		 * @param int|null $id The ID of the folder to retrieve
		 * @param int|null $parentID The ID of the parent of the folders to retrieve
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($id = null, $parentID = null, $folderTypeID = null);

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

		/**
		 * @param int $folderID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function GetPermission($folderID);

		/**
		 * @param int $folderID
		 * @param int $permission
		 * @param string|null $userGUID
		 * @param string|null $groupGUID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function SetPermission($folderID, $permission, $userGUID, $groupGUID = null);
	}
?>