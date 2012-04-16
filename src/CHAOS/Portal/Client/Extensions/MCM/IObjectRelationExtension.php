<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to create and delete ObjectRelations
	 */
	interface IObjectRelationExtension
	{
		/**
		 * @param string $object1GUID
		 * @param string $object2GUID
		 * @param int $objectRelationTypeID
		 * @param int|null $sequence
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($object1GUID, $object2GUID, $objectRelationTypeID, $sequence = null);

		/**
		 * @param string $object1GUID
		 * @param string $object2GUID
		 * @param int $objectRelationTypeID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($object1GUID, $object2GUID, $objectRelationTypeID);
	}
?>