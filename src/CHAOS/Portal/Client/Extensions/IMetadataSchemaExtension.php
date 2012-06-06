<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to retrieve and manipulate metadata schemas.
	 */
	interface IMetadataSchemaExtension
	{
		/**
		 * @param string $name
		 * @param string $schemaXML
		 * @param string|null $metadataSchemaGUID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($name, $schemaXML, $metadataSchemaGUID = null);

		/**
		 * Get a specified metadata schema or all schemas.
		 * @param string|null $metadataSchemaGUID A specific metadata schema to get or null for all schemas.
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($metadataSchemaGUID = null);

		/**
		 * @abstract
		 * @param string $name
		 * @param string $schemaXML
		 * @param string $metadataSchemaGUID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update($name, $schemaXML, $metadataSchemaGUID);

		/**
		 * @param string $metadataSchemaGUID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($metadataSchemaGUID);
	}
?>