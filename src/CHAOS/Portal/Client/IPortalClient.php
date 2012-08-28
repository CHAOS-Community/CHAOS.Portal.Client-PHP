<?php
	namespace CHAOS\Portal\Client;

	/**
	 * Allows easy communication with a Portal service
	 */
	interface IPortalClient
	{
		/**
		 * Returns the version of the client.
		 * @return string
		 */
		public function ClientVersion();

		/**
		 * Returns the protocol version used by the client.
		 * @return int
		 */
		public function ProtocolVersion();
		
		
		/**
		 * Sets a session GUID to use.
		 * @param string $guid The GUID to use.
		 * @param bool $isAuthenticated True if the GUID is authenticated.
		 */
		public function SetSessionGUID($guid, $isAuthenticated);

		/**
		 * Returns the currently used session GUID.
		 * @return string
		 */
		public function SessionGUID();

		/**
		 * Returns true if the PortalClient instance has a session.
		 * @return bool
		 */
		public function HasSession();


		/**
		 * Returns the client GUID.
		 * @return string
		 */
		public function ClientGUID();


		/**
		 * @return \CHAOS\Portal\Client\Extensions\IClientSettingsExtension
		 */
		public function ClientSettings();
		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\ISessionExtension
		 */
		public function Session();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\IUserSEttingsExtension
		 */
		public function UserSettings();

		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IEmailPasswordExtension
		 */
		public function EmailPassword();

		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\ISecureCookieExtension
		 */
		public function SecureCooke();
		

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
		 * @return \CHAOS\Portal\Client\Extensions\IObjectRelationTypeExtension
		 */
		public function ObjectRelationType();

		/**
		 * @return \CHAOS\Portal\Client\Extensions\IObjectTypeExtension
		 */
		public function ObjectType();
		
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IStatsObjectExtension
		 */
		public function StatsObject();
	}
?>