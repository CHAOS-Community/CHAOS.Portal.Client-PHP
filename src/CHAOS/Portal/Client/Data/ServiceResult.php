<?php
	namespace CHAOS\Portal\Client\Data;

	/**
	 * Represents the data returned from a service call.
	 */
	class ServiceResult
	{
		/**
		 * Returns true if the service call was a success, otherwise returns false.
		 * @return bool
		 */
		public function WasSuccess() { return is_null($this->Error()); }

		private $_error = null;
		/**
		 * @return ServiceError|null
		 */
		public function Error() { return $this->_error; }

		private $_duration;
		/**
		 * Returns the time in millieseconds it took the service to process the call.
		 * @return int|null
		 */
		public function Duration() { return $this->_duration; }

		private $_portal;
		/**
		 * @return \CHAOS\Portal\Client\Data\ModuleResult
		 */
		public function Portal() { return $this->_portal; }

		private $_emailPassword;
		/**
		 * @return \CHAOS\Portal\Client\Data\ModuleResult
		 */
		public function EmailPassword() { return $this->_emailPassword; }

		private $_mcm;
		/**
		 * @return \CHAOS\Portal\Client\Data\ModuleResult
		 */
		public function MCM() { return $this->_mcm; }

		private $_geoLocator;
		/**
		 * @return \CHAOS\Portal\Client\Data\ModuleResult
		 */
		public function GeoLocator() { return $this->_geoLocator; }

		private $_statistics;
		/**
		 * @return \CHAOS\Portal\Client\Data\ModuleResult
		 */
		public function Statistics() { return $this->_statistics; }

		function __construct($data)
		{
			if(is_a($data, "Exception"))
			{
				$this->_error = new ServiceError($data);
			}
			else
			{
				$this->_error = ServiceError::GetError($data);

				if($this->WasSuccess())
				{
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
							case "CHAOS.MCM.Module.Standard.MCMModule":
								$this->_mcm = new ModuleResult($moduleResult);
								break;
							case "CHAOS.Statistics.Module.Standard.StatisticsModule":
								$this->_statistics = new ModuleResult($moduleResult);
								break;
						}
					}
				}
			}
		}
	}
?>