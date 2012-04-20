<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class MetadataExtension extends AExtension implements IMetadataExtension
	{
		public function Set($objectGUID, $metadataSchemaGUID, $languageCode, $revisionID, $metadataXML)
		{
			return $this->CallService("Set", IServiceCaller::POST, array("objectGUID" => $objectGUID,
																		"metadataSchemaGUID" => $metadataSchemaGUID,
																		"languageCode" => $languageCode,
																		"revisionID" => $revisionID,
																		"metadataXML" => $metadataXML));
		}

		public function Get($objectGUID, $metadataSchemaGUID, $languageCode)
		{
			throw new \Exception("Method not implemented");
		}
	}
?>