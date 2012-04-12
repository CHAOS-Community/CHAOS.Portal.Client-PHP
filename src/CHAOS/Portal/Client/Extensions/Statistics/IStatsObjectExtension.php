<?php
	namespace CHAOS\Portal\Client\Extensions\Statistics;

	/**
	 * Extension to work with statistics
	 */
	interface IStatsObjectExtension
	{
		/**
		 * @param $repositoryIdentifier string
		 * @param $objectIdentifier string
		 * @param $objectTypeID int
		 * @param $objectCollectionID int
		 * @param $channelIdentifier string
		 * @param $channelTypeID int
		 * @param $eventTypeID int
		 * @param $objectTitle string
		 * @param $ip string
		 * @param $city string
		 * @param $country string
		 * @param $userSessionID int
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Set($repositoryIdentifier, $objectIdentifier, $objectTypeID, $objectCollectionID, $channelIdentifier, $channelTypeID, $eventTypeID, $objectTitle, $ip, $city, $country, $userSessionID);
	}
?>