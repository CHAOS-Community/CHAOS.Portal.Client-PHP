<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to retrieve and manipulate file referenes.
	 */
	interface IFileExtension
	{
		/**
		 * Creates a new file reference.
		 * @param string $objectGUID
		 * @param int|null $parentFileID The FileID of an original file this file was created from, otherwise null.
		 * @param int $formatID
		 * @param int $destinationID
		 * @param string $filename
		 * @param string $originalFilename
		 * @param string $folderPath
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($objectGUID, $parentFileID, $formatID, $destinationID, $filename, $originalFilename, $folderPath);

		/**
		 * Deletes a file reference
		 * @param int $ID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($ID);
	}
?>