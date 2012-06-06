<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class FolderExtension extends AExtension implements IFolderExtension
	{
		public function Create($subscriptionGUID, $title, $folderTypeID, $parentID = null)
		{
			return $this->CallService("Create", IServiceCaller::GET, array("subscriptionGUID" => $subscriptionGUID, "title" => $title, "folderTypeID" => $folderTypeID, "parentID" => $parentID));
		}
		
		public function Get($id = null, $parentID = null, $folderTypeID = null)
		{
			return $this->CallService("Get", IServiceCaller::GET, array("id" => $id, "parentID" => $parentID, "folderTypeID" => $folderTypeID));
		}

		public function Update($id, $newTitle, $newFolderTypeID)
		{
			return $this->CallService("Update", IServiceCaller::GET, array("id" => $id, "newTitle" => $newTitle, "newFolderTypeID" => $newFolderTypeID));
		}

		public function Delete($id)
		{
			return $this->CallService("Delete", IServiceCaller::GET, array("id" => $id));
		}

		public function GetPermission($folderID)
		{
			return $this->CallService("GetPermission", IServiceCaller::GET, array("folderID" => $folderID));
		}

		public function SetPermission($folderID, $permission, $userGUID, $groupGUID = null)
		{
			return $this->CallService("SetPermission", IServiceCaller::GET, array("folderID" => $folderID, "permission" => $permission, "userGUID" => $userGUID, "groupGUID" => $groupGUID));
		}
	}
?>