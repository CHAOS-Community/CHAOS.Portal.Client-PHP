<?php
	namespace CHAOS\Portal\Client\Extensions;
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
			return $this->Get($includeChildFolders ? "(FolderTree:$folderID)" : "(FolderID:$folderID)", null, $pageIndex, $pageSize, $includeMetadata, $includeFiles, $includeObjectRelations);
		}

		public function GetByObjectGUID($objectGUID, $includeMetadata = false, $includeFiles = false, $includeObjectRelations = false)
		{
			return $this->Get("(GUID:$objectGUID)", null, 0, 1, $includeMetadata, $includeFiles, $includeObjectRelations);
		}
                
		public function GetByObjectGUIDs(array $objectGUIDs, $includeMetadata = false, $includeFiles = false, $includeObjectRelations = false)
		{
			$query = array();
			
			foreach($objectGUIDs as $objectGUID)
				$query[] = "(GUID:$objectGUID)";
			
			return $this->Get("(".implode("+OR+", $query).")", null, 0, count($objectGUIDs), $includeMetadata, $includeFiles, $includeObjectRelations);
		}


		public function GetSearchSchema($query, $schemaGUID, $languageCode, $pageIndex, $pageSize, $includeMetadata = false, $includeFiles = false, $includeObjectRelations = false)
		{
			return $this->GetSearchSchemas($query, array($schemaGUID), $languageCode, $pageIndex, $pageSize, $includeMetadata, $includeFiles, $includeObjectRelations);
		}

		public function GetSearchSchemas($query, array $schemaGUIDs, $languageCode, $pageIndex, $pageSize, $includeMetadata = false, $includeFiles = false, $includeObjectRelations = false)
		{
			$searchStrings = array();
			
			foreach($schemaGUIDs as $guid)
				$searchStrings[] = "(m$guid" . "_$languageCode" . "_all:$query)";
			
			return $this->Get(implode("+OR+", $searchStrings), null, $pageIndex, $pageSize, $includeMetadata, $includeFiles, $includeObjectRelations);
		}

		public function Create($objectTypeID, $folderID, $guid = null)
		{
			return $this->CallService("Create", IServiceCaller::GET, array("objectTypeID" => $objectTypeID, "folderID" => $folderID, "guid" => $guid));
		}

		public function Delete($guid, $folderID)
		{
			throw new \Exception("Method not implemented");
		}
	}
?>