<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class FileExtension extends AExtension implements IFileExtension
	{
		public function Create($objectGUID, $parentFileID, $formatID, $destinationID, $filename, $originalFilename, $folderPath)
		{
			return $this->CallService("Create", IServiceCaller::GET, array("objectGUID" => $objectGUID, "parentFileID" => $parentFileID, "formatID" => $formatID, "destinationID" => $destinationID, "filename" => $filename, "originalFilename" => $originalFilename, "folderPath" => $folderPath));
		}

		public function Delete($ID)
		{
			return $this->CallService("Delete", IServiceCaller::GET, array("ID" => $$ID));
		}
	}
?>