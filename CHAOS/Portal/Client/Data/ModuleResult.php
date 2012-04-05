<?php
	namespace CHAOS\Portal\Client\Data;

	class ModuleResult
	{
		/**
		 * Returns true if the module processed the call successfully, otherwise returns false.
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
		 * Returns the time in millieseconds it took the module to process the call.
		 * @return int|null
		 */
		public function  Duration() { return $this->_duration; }

		private $_count = 0;
		/**
		 * The number of items returned from the module in this call.
		 * @return int
		 */
		public function  Count() { return $this->_count; }

		private $_totalCount = 0;
		public function  TotalCount() { return $this->_totalCount; }

		private $_pageIndex = 0;
		public function PageIndex() { return $this->_pageIndex; }

		private $_totalPages = 0;
		public function TotalPages() { return $this->_totalPages; }

		private $_results = array();
		public function Results() { return $this->_results; }

		function __construct($moduleResult)
		{
			$this->_duration = $moduleResult->Duration;

			$this->_error = ServiceError::GetError($moduleResult->Results);

			if($this->WasSuccess())
			{
				$this->_count = $moduleResult->Count;

				if(is_null($moduleResult->TotalCount))
					$this->_totalCount = $this->_count;
				else
					$this->_totalCount = $moduleResult->TotalCount;

				if(!is_null($moduleResult->PageIndex))
					$this->_pageIndex = $moduleResult->PageIndex;

				if(is_null($moduleResult->TotalPages))
					$this->_totalPages = $this->_count == 0 ? 0 : 1;
				else
					$this->_totalPages = $moduleResult->TotalPages;

				$this->_results = $moduleResult->Results;
			}
		}
	}
?>