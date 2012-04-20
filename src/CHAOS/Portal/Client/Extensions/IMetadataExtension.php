<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to retrieve and manipulate metadata
	 */
	interface IMetadataExtension
	{

		/**
		 * Sets the metadata on the specified object, if no metadata matches with the schema and language combination it will be created, otherwise existing metadata will be overwritten.
		 * The revisionID is required to insure the user is aware of what is overwritten.
		 * @param string $objectGUID
		 * @param int $metadataSchemaGUID
		 * @param string $languageCode
		 * @param int|null $revisionID The revision to overwrite (must be the latest), use null to create new.
		 * @param string $metadataXML
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Set($objectGUID, $metadataSchemaGUID, $languageCode, $revisionID, $metadataXML);

		/**
		 * @param string $objectGUID
		 * @param int $metadataSchemaGUID
		 * @param string $languageCode
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($objectGUID, $metadataSchemaGUID, $languageCode);
	}
?>