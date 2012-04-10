<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class MetadataSchemaExtension extends AExtension implements IMetadataSchemaExtension
	{
		public function Get($metadataSchemaGUID = null)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("metadataSchemaGUID" => $metadataSchemaGUID));
		}
	}
?>