<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to retrieve and manipulate languages.
	 */
	interface ILanguageExtension
	{
		/**
		 * @param string $name
		 * @param string $languageCode
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($name, $languageCode);
		
		/**
		 * @param string $name
		 * @param string $languageCode
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($name, $languageCode);

		/**
		 * @param string $languageCode
		 * @param string $newName
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update($languageCode, $newName);

		/**
		 * @param string $languageCode
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($languageCode);
	}
?>
