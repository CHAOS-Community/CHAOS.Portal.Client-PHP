<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Data;
	use stdClass;

	/**
	 * Represents the data returned from a service call.
	 */
	class ServiceResult
	{
		private $_wasSuccess;
		/**
		 * Returns true if the service call was a success, otherwise returns false.
		 * @return bool
		 */
		public function WasSuccess() { return $this->_wasSuccess; }

		private $_duration;
		public function Duration() { return $this->_duration; }

		private $_portal;
		public function Portal() { return $this->_portal; }

		private $_emailPassword;
		public function EmailPassword() { return $this->_emailPassword; }

		private $_mcm;
		public function MCM() { return $this->_mcm; }

		private $_geoLocator;
		public function GeoLocator() { return $this->_geoLocator; }

		private $_statistics;
		public function Statistics() { return $this->_statistics; }

		function __construct(stdClass $data)
		{
			$this->_wasSuccess = true;

			$this->_duration = $data->Duration;

			foreach($data->ModuleResults as $moduleResult)
			{
				switch($moduleResult->Fullname)
				{
					case "Geckon.Portal":
						$this->_portal = new ModuleResult($moduleResult);
						break;
					case "CHAOS.Portal.EmailPasswordModule.Standard.EmailPasswordModule":
						$this->_emailPassword = new ModuleResult($moduleResult);
						break;
				}
			}
		}
	}
?>