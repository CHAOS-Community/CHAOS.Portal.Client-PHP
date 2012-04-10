<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class FolderTypeExtension extends AExtension implements IFolderTypeExtension
	{
		public function Get($id = null, $name = null)
		{
			return $this->CallService("Set", IServiceCaller::GET, array("id" => $id,
																		"name" => $name));
		}
	}
?>