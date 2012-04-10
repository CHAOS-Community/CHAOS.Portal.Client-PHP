<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to retrieve and manipulate languages.
	 */
	interface ILanguageExtension
	{
		/**
		 * @param $name string
		 * @param $languageCode string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($name, $languageCode);
		
		/**
		 * @param $name string
		 * @param $languageCode string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($name, $languageCode);

		/**
		 * @param $languageCode string
		 * @param $newName string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update($languageCode, $newName);

		/**
		 * @param $languageCode string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($languageCode);
	}
?>
