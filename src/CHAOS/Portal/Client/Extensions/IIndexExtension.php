<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to retrieve and manipulate file referenes.
	 */
	interface IIndexExtension
	{
		/**
		 * Search in the index to retreive facet information.
		 * @param string $facet The field to do a facet on.
		 * @param string|null $query A query to restrict the search.
		 * @param string|null $accessPointGUID An optional access point GUID. 
		 */
		public function Search($facet, $query = null, $accessPointGUID = null);
	}
?>