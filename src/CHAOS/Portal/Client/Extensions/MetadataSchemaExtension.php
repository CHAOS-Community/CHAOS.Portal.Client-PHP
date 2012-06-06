<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class MetadataSchemaExtension extends AExtension implements IMetadataSchemaExtension
	{
		public function Create($name, $schemaXML, $metadataSchemaGUID = null)
		{
			return $this->CallService("Create", IServiceCaller::GET, array("name" => $name, "schemaXML" => $schemaXML, "metadataSchemaGUID" => $metadataSchemaGUID));
		}

		public function Get($metadataSchemaGUID = null)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("metadataSchemaGUID" => $metadataSchemaGUID));
		}

		public function Update($name, $schemaXML, $metadataSchemaGUID)
		{
			return $this->CallService("Update", IServiceCaller::GET, array("name" => $name, "schemaXML" => $schemaXML, "metadataSchemaGUID" => $metadataSchemaGUID));
		}

		public function Delete($metadataSchemaGUID)
		{
			return $this->CallService("Delete", IServiceCaller::GET, array("metadataSchemaGUID" => $metadataSchemaGUID));
		}
	}
?>