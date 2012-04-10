<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;

	class FolderExtension extends AExtension implements IFolderExtension
	{
		public function Create($subscriptionGUID, $title, $parentID, $folderTypeID)
		{
			throw new \Exception("Method not implemented");
		}
		
		public function Get($id, $folderTypeID, $parentID)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("id" => $id, "folderTypeID" => $folderTypeID, "parentID" => $parentID));
		}

		public function Update($id, $newTitle, $newFolderTypeID)
		{
			throw new \Exception("Method not implemented");
		}

		public function Delete($id)
		{
			throw new \Exception("Method not implemented");
		}
	}
?>