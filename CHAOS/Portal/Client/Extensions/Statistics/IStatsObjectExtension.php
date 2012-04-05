<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions\Statistics;

	/**
	 * Extension to work with statistics
	 */
	interface IStatsObjectExtension
	{
		/**
		 * @param $repositoryIdentifier
		 * @param $objectIdentifier
		 * @param $objectTypeID
		 * @param $objectCollectionID
		 * @param $channelIdentifier
		 * @param $channelTypeID
		 * @param $eventTypeID
		 * @param $objectTitle
		 * @param $ip
		 * @param $city
		 * @param $country
		 * @param $userSessionID
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Set($repositoryIdentifier, $objectIdentifier, $objectTypeID, $objectCollectionID, $channelIdentifier, $channelTypeID, $eventTypeID, $objectTitle, $ip, $city, $country, $userSessionID);
	}
?>