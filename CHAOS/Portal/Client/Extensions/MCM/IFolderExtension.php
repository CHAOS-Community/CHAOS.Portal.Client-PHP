<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 05-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to retrieve and manipulate folders
	 */
	interface IFolderExtension
	{

		/**
		 * @abstract
		 * @param $id int The ID of the folder to retrieve
		 * @param $folderTypeID int The ID of the foldertype to retrieve
		 * @param $parentID int The ID of the parent of the folders to retrieve
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($id, $folderTypeID, $parentID);
	}
?>