<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to upload files
	 */
	interface IUploadExtension
	{
		/**
		 * Initiates a upload
		 * @param string $objectGUID
		 * @param int $formatID
		 * @param int $fileSize
		 * @param bool $supportMultipleChunks
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Initiate($objectGUID, $formatID, $fileSize, $supportMultipleChunks = false);

		/**
		 * Uploads file data
		 * @param string $uploadID
		 * @param int $chunkIndex
		 * @param $fileData
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Transfer($uploadID, $chunkIndex, $fileData);
	}
?>