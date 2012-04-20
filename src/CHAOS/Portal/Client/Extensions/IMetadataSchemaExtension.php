<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to retrieve and manipulate metadata schemas.
	 */
	interface IMetadataSchemaExtension
	{
		/**
		 * Get a specified metadata schema or all schemas.
		 * @param string|null $metadataSchemaGUID A specific metadata schema to get or null for all schemas.
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($metadataSchemaGUID = null);
	}
?>