<?php
	namespace CHAOS\Portal\Client\Extensions\Statistics;

	/**
	 * Extension to work with statistics
	 */
	interface IStatsObjectExtension
	{
		/**
		 * @param $repositoryIdentifier string The identifier of the repository to group the statistics into.
		 * @param $objectIdentifier string Unique identifier for the StatsObject. Can be any string.
		 * @param $objectTypeID int The identifier for the type of StatsObject.
		 * @param $objectCollectionID int The identifier of the group within the repository.
		 * @param $channelIdentifier string The identifier of the application from where the statistics comes from.
		 * @param $channelTypeID int The identifier of for the type of channel.
		 * @param $eventTypeID int The identifier of the type of event that resulted in the statistics.
		 * @param $objectTitle string An optional title for the StatsObject. Only set first time StatsObject/Set is called with a new ObjectIdentifier.
		 * @param $ip string IP address of end user.
		 * @param $city string Cityname of end user.
		 * @param $country string Country of end user.
		 * @param $userSessionID int Identifier for the user session, returned the call for subsequent use.
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Set($repositoryIdentifier, $objectIdentifier, $objectTypeID, $objectCollectionID, $channelIdentifier, $channelTypeID, $eventTypeID, $objectTitle, $ip, $city, $country, $userSessionID);
	}
?>