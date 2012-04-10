<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class ObjectRelationExtension extends AExtension implements IObjectRelationExtension
	{
		public function Create($object1GUID, $object2GUID, $objectRelationTypeID, $sequence = null)
		{
			throw new \Exception("Method not implemented");
		}

		public function Delete($object1GUID, $object2GUID, $objectRelationTypeID)
		{
			throw new \Exception("Method not implemented");
		}
	}
?>