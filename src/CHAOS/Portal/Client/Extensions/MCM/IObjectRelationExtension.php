<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to create and delete ObjectRelations
	 */
	interface IObjectRelationExtension
	{
		/**
		 * @param $object1GUID string
		 * @param $object2GUID string
		 * @param $objectRelationTypeID int
		 * @param null $sequence int|null
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($object1GUID, $object2GUID, $objectRelationTypeID, $sequence = null);

		/**
		 * @param $object1GUID string
		 * @param $object2GUID string
		 * @param $objectRelationTypeID int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($object1GUID, $object2GUID, $objectRelationTypeID);
	}
?>