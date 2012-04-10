<?php
	namespace CHAOS\Portal\Client\Extensions\MCM;

	/**
	 * Extension to retrieve and manipulate object types.
	 */
	interface IObjectTypeExtension
	{
		/**
		 * @param $name string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Create($name);

		/**
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get();

		/**
		 * @param $id int
		 * @param $newName string
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Update($id, $newName);

		/**
		 * @param $id int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Delete($id);
	}
?>
