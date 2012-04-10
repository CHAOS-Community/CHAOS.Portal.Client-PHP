<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;
	use \CHAOS\Portal\Client\Extensions\AExtension;
	use \CHAOS\Portal\Client\IServiceCaller;
	
	class LanguageExtension extends AExtension implements ILanguageExtension
	{
		public function Create($name, $languageCode)
		{
			throw new \Exception("Method not implemented");
		}

		public function Get($name, $languageCode)
		{
			return $this->CallService("Get", IServiceCaller::GET);
		}

		public function Update($languageCode, $newName)
		{
			throw new \Exception("Method not implemented");
		}

		public function Delete($languageCode)
		{
			throw new \Exception("Method not implemented");
		}
	}
?>