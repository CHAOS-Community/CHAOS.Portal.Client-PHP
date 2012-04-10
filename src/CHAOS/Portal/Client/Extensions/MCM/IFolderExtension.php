<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to retrieve and manipulate folders
	 */
	interface IFolderExtension
	{
		/**
		 * @param $subscriptionGUID string
		 * @param $title string
		 * @param $parentID int
		 * @param $folderTypeID int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($subscriptionGUID, $title, $parentID, $folderTypeID);

		/**
		 * @param $id int The ID of the folder to retrieve
		 * @param $folderTypeID int The ID of the foldertype to retrieve
		 * @param $parentID int The ID of the parent of the folders to retrieve
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($id, $folderTypeID, $parentID);

		/**
		 * @param $id int
		 * @param $newTitle string
		 * @param $newFolderTypeID int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update($id, $newTitle, $newFolderTypeID);

		/**
		 * @param $id int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($id);
	}
?>