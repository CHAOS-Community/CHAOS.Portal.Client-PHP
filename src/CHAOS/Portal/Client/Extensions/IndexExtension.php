<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class IndexExtension extends AExtension implements IIndexExtension
	{
		public function Search($facet, $query = null, $accessPointGUID = null) {
			return $this->CallService("Search", IServiceCaller::GET, array(
				"facet" => $facet,
				"query" => $query,
				"accessPointGUID" => $accessPointGUID
			));
		}

	}
?>