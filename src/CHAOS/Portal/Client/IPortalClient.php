<?php
	namespace CHAOS\Portal\Client;

	/**
	 * Allows easy communication with a Portal service
	 */
	interface IPortalClient
	{
		/**
		 * Sets a session GUID to use.
		 * @param $value string The GUID to use.
		 */
		public function SetCurrentSessionGUID($value);

		/**
		 * Returns the currently used session GUID.
		 * @return string
		 */
		public function GetCurrentSessionGUID();

		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\ISessionExtension
		 */
		public function Session();

		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IEmailPasswordExtension
		 */
		public function EmailPassword();


		/**
		 * @return \CHAOS\Portal\Client\Extensions\IFileExtension
		 */
		public function File();
		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IFolderExtension
		 */
		public function Folder();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\IFolderTypeExtension
		 */
		public function FolderType();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\IFormatExtension
		 */
		public function Format();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\ILanguageExtension
		 */
		public function Language();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\ILinkExtension
		 */
		public function Link();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\IMetadataExtension
		 */
		public function Metadata();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\IMetadataSchemaExtension
		 */
		public function MetadataSchema();
		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IObjectExtension
		 */
		public function Object();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\IObjectRelationExtension
		 */
		public function ObjectRelation();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\ObjectRelationTypeExtension
		 */
		public function ObjectRelationType();

		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IStatsObjectExtension
		 */
		public function StatsObject();
	}
?>