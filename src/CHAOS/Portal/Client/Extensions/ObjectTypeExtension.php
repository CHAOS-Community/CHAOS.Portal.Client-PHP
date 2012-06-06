<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class ObjectTypeExtension extends AExtension implements IObjectTypeExtension
	{
		public function Create($name)
		{
			return $this->CallService("Create", IServiceCaller::GET, array( "name" => $name));
		}

		public function Get()
		{
			return $this->CallService("Get", IServiceCaller::GET);
		}

		public function Update($id, $newName)
		{
			return $this->CallService("Update", IServiceCaller::GET, array( "id" => $id, "newName" => $newName));
		}

		public function Delete($id)
		{
			return $this->CallService("Delete", IServiceCaller::GET, array( "id" => $id));
		}
	}

?>