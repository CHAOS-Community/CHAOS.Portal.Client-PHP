<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class MetadataExtension extends AExtension implements IMetadataExtension
	{
		public function Set($objectGUID, $metadataSchemaID, $languageCode, $metadataXML)
		{
			return $this->CallService("Set", IServiceCaller::POST, array("objectGUID" => $objectGUID,
																		"metadataSchemaID" => $metadataSchemaID,
																		"languageCode" => $languageCode,
																		"metadataXML" => $metadataXML));
		}

		public function Get($objectGUID, $metadataSchemaGUID, $languageCode)
		{
			throw new \Exception("Method not implemented");
		}
	}
?>