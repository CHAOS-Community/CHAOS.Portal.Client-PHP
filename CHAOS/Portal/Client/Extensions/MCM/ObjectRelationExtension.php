<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class ObjectRelationExtension extends AExtension implements IObjectRelationExtension
	{
		public function Create($objectFromGUID, $objectToGUID, $relationTypeID)
		{
			throw new \Exception("Method not implemented");
		}

		public function Delete($objectFromGUID, $objectToGUID, $relationTypeID)
		{
			throw new \Exception("Method not implemented");
		}
	}

?>