<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class FormatExtension extends AExtension implements IFormatExtension
	{
		public function Create($name)
		{
			return $this->CallService("Create", IServiceCaller::GET, array("name" => $name));
		}
		
		public function Get($id, $name)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("id" => $id, "name" => $name));
		}

		public function Update($id, $newName)
		{
			return $this->CallService("Update", IServiceCaller::GET, array("id" => $id, "newName" => $newName));
		}

		public function Delete($id)
		{
			return $this->CallService("Delete", IServiceCaller::GET, array("id" => $id));
		}
	}

?>