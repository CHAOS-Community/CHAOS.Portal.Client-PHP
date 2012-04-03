<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to search for and manipulate Objects.
	 */
	interface IObjectExtension
	{
		public function Get($query, $sort, $includeMetadata, $includeFiles, $includeObjectRelations, $pageIndex, $pageSize);
	}
?>