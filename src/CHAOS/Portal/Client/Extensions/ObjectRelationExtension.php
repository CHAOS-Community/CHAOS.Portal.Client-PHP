<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class ObjectRelationExtension extends AExtension implements IObjectRelationExtension
	{
		public function Create($object1GUID, $object2GUID, $objectRelationTypeID, $sequence = null)
		{
			return $this->CallService("Create", IServiceCaller::GET, array("object1GUID" => $object1GUID, "object2GUID" => $object2GUID, "objectRelationTypeID" => $objectRelationTypeID, "sequence" => $sequence));
		}

		public function Delete($object1GUID, $object2GUID, $objectRelationTypeID)
		{
			return $this->CallService("Delete", IServiceCaller::GET, array("object1GUID" => $object1GUID, "object2GUID" => $object2GUID, "objectRelationTypeID" => $objectRelationTypeID));
		}
	}
?>