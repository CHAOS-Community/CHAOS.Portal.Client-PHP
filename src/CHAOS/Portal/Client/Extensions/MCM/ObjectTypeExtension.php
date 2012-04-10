<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class ObjectTypeExtension extends AExtension implements IObjectTypeExtension
	{
		public function Create($name)
		{
			throw new \Exception("Method not implemented");
		}

		public function Get()
		{
			return $this->CallService("Get", IServiceCaller::GET);
		}

		public function Update($id, $newName)
		{
			throw new \Exception("Method not implemented");
		}

		public function Delete($id)
		{
			throw new \Exception("Method not implemented");
		}
	}

?>