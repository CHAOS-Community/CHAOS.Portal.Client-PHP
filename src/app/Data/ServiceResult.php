<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Data;

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
		public function GetWasSuccess() { return $this->_wasSuccess; }

		private $_data;
		/**
		 * Returns the data returned from the call.
		 * @return object
		 */
		public function GetData()	{ return $this->_data; }

		function __construct($wassSuccess, \object $data)
		{
			$this->_wasSuccess = $wassSuccess;
			$this->_data = $data;
		}
	}
?>