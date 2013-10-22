<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class FolderTypeExtension extends AExtension implements IFolderTypeExtension
	{
		public function Get($id = null, $name = null)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("id" => $id, "name" => $name));
		}
	}
?>