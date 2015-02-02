<?php
	namespace CHAOS\Portal\Client;
	use Exception;
	use \CHAOS\Portal\Client\Data\ServiceResult;
	use \CHAOS\Portal\Client\Extensions\SessionExtension;
	use \CHAOS\Portal\Client\Extensions\ClientSettingsExtension;
	use \CHAOS\Portal\Client\Extensions\UserSettingsExtension;
	use \CHAOS\Portal\Client\Extensions\EmailPasswordExtension;
	use \CHAOS\Portal\Client\Extensions\SecureCookieExtension;
	use \CHAOS\Portal\Client\Extensions\ObjectExtension;
	use \CHAOS\Portal\Client\Extensions\ObjectRelationExtension;
	use \CHAOS\Portal\Client\Extensions\FileExtension;
	use \CHAOS\Portal\Client\Extensions\FolderExtension;
	use \CHAOS\Portal\Client\Extensions\FolderTypeExtension;
	use \CHAOS\Portal\Client\Extensions\FormatExtension;
	use \CHAOS\Portal\Client\Extensions\MetadataSchemaExtension;
	use \CHAOS\Portal\Client\Extensions\MetadataExtension;
	use \CHAOS\Portal\Client\Extensions\ObjectRelationTypeExtension;
	use \CHAOS\Portal\Client\Extensions\ObjectTypeExtension;
	use \CHAOS\Portal\Client\Extensions\LanguageExtension;
	use \CHAOS\Portal\Client\Extensions\LinkExtension;
	use \CHAOS\Portal\Client\Extensions\StatsObjectExtension;
	use \CHAOS\Portal\Client\Extensions\UploadExtension;
	use \CHAOS\Portal\Client\Extensions\IndexExtension;

	class PortalClient implements IPortalClient, IServiceCaller
	{
		const CLIENT_VERSION = "1.1.1";
		const PROTOCOL_VERSION = 4;
		const FORMAT = "json";
		const USE_HTTP_STATUS_CODES = false;
		const TIMEOUT = 10;

		private $_servicePath = null;
		private $_clientGUID = null;
		private $_curlHandle = null;

		/**
		 * Returns the version of the client.
		 * @return string
		 */
		public function ClientVersion()	{ return self::CLIENT_VERSION; }

		/**
		 * Returns the protocol version used by the client.
		 * @return int
		 */
		public function ProtocolVersion() { return self::PROTOCOL_VERSION; }

		private $_currentSessionGUID = null;
		/**
		 * Sets a session GUID to use.
		 * @param string  $guid The GUID to use.
		 * @param bool $isAuthenticated True if the GUID is authenticated.
		 */
		public function SetSessionGUID($guid, $isAuthenticated) { $this->_currentSessionGUID = $guid; }
		/**
		 * Returns the currently used session GUID.
		 * @return string
		 */
		public function SessionGUID() { return $this->_currentSessionGUID; }

		/**
		 * Returns true if the PortalClient instance has a session.
		 * @return bool
		 */
		public function HasSession() { return $this->SessionGUID() != null; }

		/**
		 * Returns the client GUID.
		 * @return string
		 */
		public function ClientGUID() { return $this->_clientGUID; }

		/**
		 * @param String $servicePath The URL of the Portal service.
		 * @param String $clientGUID The GUID by which the client is identified.
		 * @param Bool $autoCreateSession If true a session will be created in the constructor call.
		 */
		public function __construct($servicePath, $clientGUID, $autoCreateSession = true)
		{
			$servicePath = $this->ValidateServicePath($servicePath);

			if(!isset($clientGUID))
				throw new Exception("Parameter clientGUID must be set");

			$this->_servicePath = $servicePath;
			$this->_clientGUID = $clientGUID;
			
			if ($autoCreateSession) {
				$response = $this->Session()->Create();
				if(!$response->WasSuccess()) {
					throw new \RuntimeException("Couldn't autocreate session: ".$response->Error()->Message());
				}
			}
		}
		
		public function __destruct() {
			if($this->_curlHandle !== null) {
				\curl_close($this->_curlHandle);
			}
		}

		private function ValidateServicePath($servicePath)
		{
			if(!isset($servicePath))
				throw new Exception("Parameter servicePath must be set");

			if(substr($servicePath, -1, 1) != "/")
				$servicePath .= "/";

			return $servicePath;
		}

		public function CallService($path, $method, array $parameters = null, $requiresSession = true)
		{
			try
			{
				if(is_null($parameters))
					$parameters = array();
				
				if($requiresSession)
				{
					if($this->SessionGUID() == null)
						throw new Exception("Session was not created");

					$parameters["sessionGUID"] = $this->SessionGUID();
				}

				$parameters["format"] = self::FORMAT;
				$parameters["useHTTPStatusCodes"] = self::USE_HTTP_STATUS_CODES;

				foreach($parameters as $name => $value)
					if(is_bool($value))
						$parameters[$name] = $value ? "true" : "false";

				$path = $this->_servicePath . $path;

				if($this->_curlHandle === null) {
					$this->_curlHandle = \curl_init();
					\curl_setopt($this->_curlHandle, CURLOPT_RETURNTRANSFER, true);
					\curl_setopt($this->_curlHandle, CURLOPT_TIMEOUT, self::TIMEOUT);
				}

				if($method == IServiceCaller::POST)
				{
					\curl_setopt($this->_curlHandle, CURLOPT_POST, true);
					\curl_setopt($this->_curlHandle, CURLOPT_POSTFIELDS, http_build_query($parameters)); //Remove http_build_query call to use "multipart/form-data"
				} else {
					\curl_setopt($this->_curlHandle, CURLOPT_POST, false);
					$path .= "?" . http_build_query($parameters);
				}
				\curl_setopt($this->_curlHandle, CURLOPT_URL, $path);

				$data = \curl_exec($this->_curlHandle);
				
				if($data == null)
					$data = new Exception("No data returned from service");
				else
				{
					if(ord($data[1]) === 0) {
						// Hotfixes a bug on v4 of the service.
						$data = @iconv( "UTF-16LE", "UTF-8", $data);
					}
					if($data === false || is_null($data) || $data == "")
						$data = new Exception("Invalid data returned from service");
					else
					{
						$data = json_decode($data);
						
						if($data == null)
							$data = new Exception("Invalid data returned from service");
					}
				}

				return new ServiceResult($data);
			}
			catch(Exception $e)
			{
				return new ServiceResult($e);
			}
		}

		private $_session = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\ISessionExtension
		 */
		public function Session()
		{
			if($this->_session == null)
			{
				$client = $this; //Used for closure
				$this->_session = new SessionExtension($this, self::PROTOCOL_VERSION, function($result) use ($client)
				{
					if($result->WasSuccess() && $result->Portal() != null && $result->Portal()->WasSuccess())
					{
						$sessions = $result->Portal()->Results();
						
						if(count($sessions) == 1 && isset($sessions[0]->SessionGUID))
							$client->SetSessionGUID($sessions[0]->SessionGUID, false);
					}
				});
			}

			return $this->_session;
		}

		private $_clientSettings = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IClientSettingsExtension
		 */
		public function ClientSettings()
		{
			if(is_null($this->_clientSettings))
				$this->_clientSettings = new ClientSettingsExtension($this, $this);

			return $this->_clientSettings;
		}

		private $_userSettings = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IUserSettingsExtension
		 */
		public function UserSettings()
		{
			if(is_null($this->_userSettings == null))
				$this->_userSettings = new UserSettingsExtension($this, $this);

			return $this->_userSettings;
		}


		private $_emailPassword = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IEmailPasswordExtension
		 */
		public function EmailPassword()
		{
			if($this->_emailPassword == null)
				$this->_emailPassword = new EmailPasswordExtension($this);

			return $this->_emailPassword;
		}

		private $_secureCookie = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\ISecureCookieExtension
		 */
		public function SecureCooke()
		{
			if($this->_secureCookie == null)
				$this->_secureCookie = new SecureCookieExtension($this);

			return $this->_secureCookie;
		}

		private $_object = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IObjectExtension
		 */
		public function Object()
		{
			if($this->_object == null)
				$this->_object = new ObjectExtension($this);

			return $this->_object;
		}

		private $_objectRelation = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IObjectRelationExtension
		 */
		public function ObjectRelation()
		{
			if($this->_objectRelation == null)
				$this->_objectRelation = new ObjectRelationExtension($this);

			return $this->_objectRelation;
		}

		private $_objectType = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IObjectTypeExtension
		 */
		public function ObjectType()
		{
			if($this->_objectType == null)
				$this->_objectType = new ObjectTypeExtension($this);

			return $this->_objectType;
		}

		private $_file = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IFileExtension
		 */
		public function File()
		{
			if($this->_file == null)
				$this->_file = new FileExtension($this);

			return $this->_file;
		}

		private $_folder = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IFolderExtension
		 */
		public function Folder()
		{
			if($this->_folder == null)
				$this->_folder = new FolderExtension($this);

			return $this->_folder;
		}

		private $_folderType = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IFolderTypeExtension
		 */
		public function FolderType()
		{
			if($this->_folderType == null)
				$this->_folderType = new FolderTypeExtension($this);

			return $this->_folderType;
		}

		private $_format = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IFormatExtension
		 */
		public function Format()
		{
			if($this->_format == null)
				$this->_format = new FormatExtension($this);

			return $this->_format;
		}

		private $_language = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\ILanguageExtension
		 */
		public function Language()
		{
			if($this->_language == null)
				$this->_language = new LanguageExtension($this);

			return $this->_language;
		}

		private $_link = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\ILinkExtension
		 */
		public function Link()
		{
			if($this->_link == null)
				$this->_link = new LinkExtension($this);

			return $this->_link;
		}

		private $_metadata = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IMetadataExtension
		 */
		public function Metadata()
		{
			if($this->_metadata == null)
				$this->_metadata = new MetadataExtension($this);

			return $this->_metadata;
		}

		private $_metadataSchema = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IMetadataSchemaExtension
		 */
		public function MetadataSchema()
		{
			if($this->_metadataSchema == null)
				$this->_metadataSchema = new MetadataSchemaExtension($this);

			return $this->_metadataSchema;
		}

		private $_objectRelationType = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IObjectRelationTypeExtension
		 */
		public function ObjectRelationType()
		{
			if($this->_objectRelationType == null)
				$this->_objectRelationType = new ObjectRelationTypeExtension($this);

			return $this->_objectRelationType;
		}

		private $_statsObject = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IStatsObjectExtension
		 */
		public function StatsObject()
		{
			if($this->_statsObject == null)
				$this->_statsObject = new StatsObjectExtension($this);

			return $this->_statsObject;
		}

		private $_upload = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IUploadExtension
		 */
		public function Upload()
		{
			if($this->_upload == null)
				$this->_upload = new UploadExtension($this);

			return $this->_upload;
		}

		private $_index = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\IIndexExtension
		 */
		public function Index()
		{
			if($this->_index == null)
				$this->_index = new IndexExtension($this);

			return $this->_index;
		}
	}
?>