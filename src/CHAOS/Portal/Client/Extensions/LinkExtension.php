<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class LinkExtension extends AExtension implements ILinkExtension
	{
		public function Create($objectGUID, $folderID)
		{
			return $this->CallService("Create", IServiceCaller::GET, array("objectGUID" => $objectGUID, "folderID" => $folderID));
		}

		public function Update($objectGUID, $folderID, $newFolderID)
		{
			return $this->CallService("Update", IServiceCaller::GET, array("objectGUID" => $objectGUID, "folderID" => $folderID, "newFolderID" => $newFolderID));
		}

		public function Delete($objectGUID, $folderID)
		{
			return $this->CallService("Delete", IServiceCaller::GET, array("objectGUID" => $objectGUID, "folderID" => $folderID));
		}
	}

?>