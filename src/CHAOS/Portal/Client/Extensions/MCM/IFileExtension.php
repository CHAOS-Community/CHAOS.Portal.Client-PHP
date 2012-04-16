<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to retrieve and manipulate file referenes.
	 */
	interface IFileExtension
	{
		/**
		 * Creates a new file reference.
		 * @param $objectGUID string
		 * @param $parentFileID int|null The FileID of an original file this file was created from, otherwise null.
		 * @param $formatID int
		 * @param $destinationID int
		 * @param $filename string
		 * @param $originalFilename string
		 * @param $folderPath string
		 */
		public function Create($objectGUID, $parentFileID, $formatID, $destinationID, $filename, $originalFilename, $folderPath);
	}

?>