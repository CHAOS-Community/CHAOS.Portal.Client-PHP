<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to retrieve and manipulate metadata
	 */
	interface IMetadataExtension
	{

		/**
		 * Sets the metadata on the specified object, if no metadata matches with the schema and language combination it will be created, otherwise existing metadata will be overwritten.
		 * @param $objectGUID string
		 * @param $metadataSchemaID int
		 * @param $languageCode string
		 * @param $metadataXML string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Set($objectGUID, $metadataSchemaID, $languageCode, $metadataXML);
	}
?>