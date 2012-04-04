<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 04-04-12
	 */
	namespace CHAOS\Portal\Client\Data;

	class ModuleResult
	{
		private $_duration;
		public function  Duration() { return $this->_duration; }

		private $_count;
		public function  Count() { return $this->_count; }

		private $_totalCount;
		public function  TotalCount() { return $this->_totalCount; }

		private $_pageIndex;
		public function PageIndex() { return $this->_pageIndex; }

		private $_totalPages;
		public function TotalPages() { return $this->_totalPages; }

		private $_results;
		public function Results() { return $this->_results; }

		function __construct($moduleResult)
		{
			$this->_duration = $moduleResult->Duration;
			$this->_count = $moduleResult->Count;
			$this->_totalCount = $moduleResult->TotalCount;
			$this->_pageIndex = $moduleResult->PageIndex;
			$this->_totalPages = $moduleResult->TotalPages;
			$this->_results = $moduleResult->Results;
		}
	}
?>