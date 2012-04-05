<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class ObjectExtension extends AExtension implements IObjectExtension
	{
		public function Get($query, $sort, $includeMetadata, $includeFiles, $includeObjectRelations, $pageIndex, $pageSize)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("query" => $query,
																		"sort" => $sort,
																		"includeMetadata" => $includeMetadata,
																		"includeFiles" => $includeFiles,
																		"includeObjectRelations" => $includeObjectRelations,
																		"pageIndex" => $pageIndex,
																		"pageSize" => $pageSize));
		}
	}
?>