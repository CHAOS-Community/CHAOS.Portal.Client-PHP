<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to search for and manipulate Objects.
	 */
	interface IObjectExtension
	{
		/**
		 * @param $query string
		 * @param $sort string
		 * @param $includeMetadata bool
		 * @param $includeFiles bool
		 * @param $includeObjectRelations bool
		 * @param $pageIndex int
		 * @param $pageSize int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($query, $sort, $includeMetadata, $includeFiles, $includeObjectRelations, $pageIndex, $pageSize);

		/**
		 * @param $folderID int
		 * @param $includeChildFolders bool
		 * @param $includeMetadata bool
		 * @param $includeFiles bool
		 * @param $includeObjectRelations bool
		 * @param $pageIndex int
		 * @param $pageSize int
		 */
		public function GetByFolderID($folderID, $includeChildFolders, $includeMetadata, $includeFiles, $includeObjectRelations, $pageIndex, $pageSize);

		/**
		 * @param $objectGUID string
		 * @param $includeMetadata bool
		 * @param $includeFiles bool
		 * @param $includeObjectRelations bool
		 */
		public function GetByObjectGUID($objectGUID, $includeMetadata, $includeFiles, $includeObjectRelations);

		/**
		 * @param $objectTypeID int
		 * @param $folderID int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($objectTypeID, $folderID);
	}
?>