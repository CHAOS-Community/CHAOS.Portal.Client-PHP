<?php
	namespace CHAOS\Portal\Client;
	use Exception;
	use \CHAOS\Portal\Client\Data\ServiceResult;
	use \CHAOS\Portal\Client\Extensions\Portal\SessionExtension;
	use \CHAOS\Portal\Client\Extensions\Portal\EmailPasswordExtension;
	use \CHAOS\Portal\Client\Extensions\MCM\ObjectExtension;
	use \CHAOS\Portal\Client\Extensions\Statistics\StatsObjectExtension;

	class PortalClient implements IPortalClient, IServiceCaller
	{
		const PROTOCOL_VERSION = 4;
		const FORMAT = "json";
		const USE_HTTP_STATUS_CODES = false;

		private $_servicePath = null;
		private $_clientGUID = null;

		private $_currentSession = null;

		/**
		 * @param String $servicePath The URL of the Portal service.
		 * @param String $clientGUID The GUID by which the client is identified.
		 */
		public function __construct($servicePath, $clientGUID)
		{
			if(!isset($servicePath))
				throw new Exception("Parameter servicePath must be set");

			if(!isset($clientGUID))
				throw new Exception("Parameter clientGUID must be set");

			$this->_servicePath = $servicePath;
			$this->_clientGUID = $clientGUID;
		}

		public function CallService($path, $method, array $parameters, $requiresSession)
		{
			if($requiresSession)
			{
				if($this->_currentSession == null)
					throw new Exception("Session was not created");

				$parameters["SessionGUID"] = $this->_currentSession->GUID;
			}

			$parameters["format"] = self::FORMAT;
			$parameters["useHTTPStatusCodes"] = self::USE_HTTP_STATUS_CODES;

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

			$data = json_encode(curl_exec($call));
			curl_close($call);

			return new ServiceResult(true, $data);
		}

		private function SessionCreated($session)
		{
			$this->_currentSession = $session;
		}

		private $_session = null;
		public function Session()
		{
			if($this->_session == null)
				$this->_session = new SessionExtension($this, self::PROTOCOL_VERSION, $this->SessionCreated);

			return $this->_session;
		}

		private $_emailPassword = null;
		public function EmailPassword()
		{
			if($this->_emailPassword == null)
				$this->_emailPassword = new EmailPasswordExtension($this);

			return $this->_session;
		}

		private $_object = null;
		public function Object()
		{
			if($this->_object == null)
				$this->_object = new ObjectExtension($this);

			return $this->_object;
		}

		private $_statsObject = null;
		public function StatsObject()
		{
			if($this->_statsObject == null)
				$this->_statsObject = new StatsObjectExtension($this);

			return $this->_statsObject;
		}
	}
?>