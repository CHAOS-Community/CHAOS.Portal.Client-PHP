<?php
	namespace CHAOS\Portal\Client;
	use Exception;
	use \CHAOS\Portal\Client\Data\ServiceResult;
	use \CHAOS\Portal\Client\Extensions\Portal\SessionExtension;
	use \CHAOS\Portal\Client\Extensions\EmailPassword\EmailPasswordExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\ObjectExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\FolderExtension;
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
			if(!isset($servicePath))
				throw new Exception("Parameter servicePath must be set");

			if(!isset($clientGUID))
				throw new Exception("Parameter clientGUID must be set");

			$this->_servicePath = $servicePath;
			$this->_clientGUID = $clientGUID;

			$this->Session()->Create();
		}

		public function CallService($path, $method, array $parameters, $requiresSession)
		{
			try
			{
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

				$data = json_decode(iconv( "UTF-16LE", "UTF-8", curl_exec($call)));
				curl_close($call);

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