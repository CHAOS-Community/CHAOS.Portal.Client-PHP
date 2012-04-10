<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class ObjectRelationTypeExtension extends AExtension implements IObjectRelationTypeExtension
	{
		public function Get($id = null, $value = null)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("id" => $id,
																		"value" => $value));
		}
	}
?>