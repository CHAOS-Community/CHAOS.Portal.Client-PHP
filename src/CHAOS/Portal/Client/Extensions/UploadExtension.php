<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class UploadExtension extends AExtension implements IUploadExtension
	{
		public function Initiate($objectGUID, $formatTypeID, $fileSize, $supportMultipleChunks = false)
		{
			return $this->CallService("Initiate", IServiceCaller::GET, array("objectGUID" => $objectGUID, "formatTypeID" => $formatTypeID, "fileSize" => $fileSize, "supportMultipleChunks" => $supportMultipleChunks));
		}

		public function Transfer($uploadID, $chunkIndex, $fileData)
		{
			throw new \Exception("Not implemented");
			return $this->CallService("Transfer", IServiceCaller::POST, array("uploadID" => $uploadID, "chunkIndex" => $chunkIndex, "fileData" => $fileData));
		}
	}
?>