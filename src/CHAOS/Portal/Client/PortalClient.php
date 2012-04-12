<?php
	namespace CHAOS\Portal\Client;
	use Exception;
	use \CHAOS\Portal\Client\Data\ServiceResult;
	use \CHAOS\Portal\Client\Extensions\Portal\SessionExtension;
	use \CHAOS\Portal\Client\Extensions\EmailPassword\EmailPasswordExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\ObjectExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\ObjectRelationExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\FolderExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\FolderTypeExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\MetadataSchemaExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\MetadataExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\ObjectRelationTypeExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\LanguageExtension;
	use \CHAOS\Portal\Client\Extensions\Statistics\StatsObjectExtension;

	class PortalClient implements IPortalClient, IServiceCaller
	{
		const PROTOCOL_VERSION = 4;
		const FORMAT = "json";
		const USE_HTTP_STATUS_CODES = false;

		private $_servicePath = null;
		private $_clientGUID = null;

		private $_currentSessionGUID = null;
		public function SetCurrentSessionGUID($value) { $this->_currentSessionGUID = $value; }
		public function GetCurrentSessionGUID() { return $this->_currentSessionGUID; }

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

			$this->Session()->Create();
		}

		private function ValidateServicePath($servicePath)
		{
			if(!isset($servicePath))
				throw new Exception("Parameter servicePath must be set");

			if(substr($servicePath, -1, 1) != "/")
				$servicePath .= "/";

			return $servicePath;
		}

		public function CallService($path, $method, array $parameters, $requiresSession)
		{
			try
			{
				if(is_null($parameters))
					$parameters = array();
				
				if($requiresSession)
				{
					if($this->GetCurrentSessionGUID() == null)
						throw new Exception("Session was not created");

					$parameters["SessionGUID"] = $this->GetCurrentSessionGUID();
				}

				$parameters["format"] = self::FORMAT;
				$parameters["useHTTPStatusCodes"] = self::USE_HTTP_STATUS_CODES;

				foreach($parameters as $name => $value)
					if(is_bool($value))
						$parameters[$name] = $value ? "true" : "false";

				$path = $this->_servicePath . $path;

				$call = curl_init();

				if($method == IServiceCaller::POST)
				{
					curl_setopt($call, CURLOPT_POST, true);
					curl_setopt($call, CURLOPT_POSTFIELDS, http_build_query($parameters)); //Remove http_build_query call to use "multipart/form-data"
				}
				else
					$path .= "?" . http_build_query($parameters);

				curl_setopt($call, CURLOPT_URL, $path);
				curl_setopt($call, CURLOPT_RETURNTRANSFER, true);

				$data = curl_exec($call);
				curl_close($call);
				
				if($data == null)
					$data = new Exception("No data returned from service");
				else
				{
					$data = iconv( "UTF-16LE", "UTF-8", $data);

					if($data === false)
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
		 * @return \CHAOS\Portal\Client\Extensions\Portal\ISessionExtension
		 */
		public function Session()
		{
			if($this->_session == null)
			{
				$client = $this; //Used for closure
				$this->_session = new SessionExtension($this, self::PROTOCOL_VERSION, function($result) use ($client)
				{
					$sessions = $result->Portal()->Results();
					$client->SetCurrentSessionGUID($sessions[0]->SessionGUID);
				});
			}

			return $this->_session;
		}

		private $_emailPassword = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\EmailPassword\IEmailPasswordExtension
		 */
		public function EmailPassword()
		{
			if($this->_emailPassword == null)
				$this->_emailPassword = new EmailPasswordExtension($this);

			return $this->_emailPassword;
		}

		private $_object = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\IObjectExtension
		 */
		public function Object()
		{
			if($this->_object == null)
				$this->_object = new ObjectExtension($this);

			return $this->_object;
		}

		private $_objectRelation = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\IObjectRelationExtension
		 */
		public function ObjectRelation()
		{
			if($this->_objectRelation == null)
				$this->_objectRelation = new ObjectRelationExtension($this);

			return $this->_objectRelation;
		}

		private $_folder = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\IFolderExtension
		 */
		public function Folder()
		{
			if($this->_folder == null)
				$this->_folder = new FolderExtension($this);

			return $this->_folder;
		}

		private $_folderType = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\IFolderTypeExtension
		 */
		public function FolderType()
		{
			if($this->_folderType == null)
				$this->_folderType = new \CHAOS\Portal\Client\Extensions\MCM\FolderTypeExtension($this);

			return $this->_folderType;
		}

		private $_language = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\LanguageExtension
		 */
		public function Language()
		{
			if($this->_language == null)
				$this->_language = new LanguageExtension($this);

			return $this->_language;
		}

		private $_metadata = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\MetadataExtension
		 */
		public function Metadata()
		{
			if($this->_metadata == null)
				$this->_metadata = new MetadataExtension($this);

			return $this->_metadata;
		}

		private $_metadataSchema = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\MetadataSchemaExtension
		 */
		public function MetadataSchema()
		{
			if($this->_metadataSchema == null)
				$this->_metadataSchema = new MetadataSchemaExtension($this);

			return $this->_metadataSchema;
		}

		private $_objectRelationType = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\MCM\ObjectRelationTypeExtension
		 */
		public function ObjectRelationType()
		{
			if($this->_objectRelationType == null)
				$this->_objectRelationType = new ObjectRelationTypeExtension($this);

			return $this->_objectRelationType;
		}

		private $_statsObject = null;
		/**
		 * @return \CHAOS\Portal\Client\Extensions\Statistics\IStatsObjectExtension
		 */
		public function StatsObject()
		{
			if($this->_statsObject == null)
				$this->_statsObject = new StatsObjectExtension($this);

			return $this->_statsObject;
		}
	}
?>