<?php
	namespace CHAOS\Portal\Client\Data;
	use stdClass;

	/**
	 * Represents an error recieved from a service.
	 */
	class ServiceError
	{
		private $_name;
		public function Name() { return $this->_name; }

		private $_message;
		public function Message() { return $this->_message; }

		private $_stacktrace;
		public function Stacktrace() { return $this->_stacktrace; }

		public function __construct($data)
		{
			if(is_a($data, "Exception"))
			{
				$this->_name = "ServiceCallFailedException";
				$this->_message = $data->getMessage();
			}
			else
			{
				$this->_name = $data->Fullname;
				$this->_message = $data->Message;
				$this->_stacktrace = $data->Stacktrace;
			}
		}

		private static function IsError(stdClass $data)
		{
			return isset($data->Fullname) && strrpos($data->Fullname, "Exception") !== false;
		}

		private static function HasError(array $data)
		{
			return count($data) == 1 && static::IsError($data[0]);
		}

		public static function GetError($data)
		{
			if(is_null($data))
				return null;
			
			if(is_array($data))
			{
				if(static::HasError($data))
					return new ServiceError($data[0]);
			}
			else if(static::IsError($data))
				return new ServiceError($data);

			return null;
		}
	}
?>