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

		public function __construct(stdClass $data)
		{
			$this->_name = $data->Fullname;
			$this->_message = $data->Message;
		}

		public static function IsError(stdClass $data)
		{
			return isset($data->Fullname) && strrpos($data->Fullname, "Exception") !== false;
		}

		public static function HasError(array $data)
		{
			return is_array($data) && count($data) == 1 && static::IsError($data[0]);
		}

		public static function GetError(array $data)
		{
			return static::HasError($data) ? new ServiceError($data[0]) : null;
		}
	}
?>