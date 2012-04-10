<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class ObjectExtension extends AExtension implements IObjectExtension
	{
		public function Get($query, $sort, $pageIndex, $pageSize, $includeMetadata = false, $includeFiles = false, $includeObjectRelations = false)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("query" => $query,
																		"sort" => $sort,
																		"includeMetadata" => $includeMetadata,
																		"includeFiles" => $includeFiles,
																		"includeObjectRelations" => $includeObjectRelations,
																		"pageIndex" => $pageIndex,
																		"pageSize" => $pageSize));
		}

		public function GetByFolderID($folderID, $includeChildFolders, $pageIndex, $pageSize, $includeMetadata = false, $includeFiles = false, $includeObjectRelations = false)
		{
			return $this->Get($includeChildFolders ? "(FolderTree:$folderID)" : "(FolderID:$folderID)", null, $includeMetadata, $includeFiles, $includeObjectRelations, $pageIndex, $pageSize);
		}

		public function GetByObjectGUID($objectGUID, $includeMetadata, $includeFiles, $includeObjectRelations)
		{
			return $this->Get("(GUID:$objectGUID)", null, $includeMetadata, $includeFiles, $includeObjectRelations, 0, 1);
		}

		public function Create($objectTypeID, $folderID)
		{
			throw new \Exception("Method not implemented");
		}
	}
?>