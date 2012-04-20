<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class MetadataSchemaExtension extends AExtension implements IMetadataSchemaExtension
	{
		public function Get($metadataSchemaGUID = null)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("metadataSchemaGUID" => $metadataSchemaGUID));
		}
	}
?>