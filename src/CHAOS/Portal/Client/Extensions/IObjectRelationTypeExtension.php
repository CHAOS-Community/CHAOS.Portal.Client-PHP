<?php
	namespace CHAOS\Portal\Client\Extensions;

	/**
	 * Extension to create and delete object relation types.
	 */
	interface IObjectRelationTypeExtension
	{
		/**
		 * @param int|null $id
		 * @param string|null $value
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Get($id = null, $value = null);
	}
?>
