<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to create and delete ObjectRelations
	 */
	interface IObjectRelationExtension
	{
		/**
		 * @param $objectFromGUID string
		 * @param $objectToGUID string
		 * @param $relationTypeID int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($objectFromGUID, $objectToGUID, $relationTypeID);

		/**
		 * @param $objectFromGUID string
		 * @param $objectToGUID string
		 * @param $relationTypeID string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($objectFromGUID, $objectToGUID, $relationTypeID);
	}
?>