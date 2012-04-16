<?php
	namespace CHAOS\Portal\Client\Extensions\Statistics;

	/**
	 * Extension to work with statistics
	 */
	interface IStatsObjectExtension
	{
		/**
		 * @param string $repositoryIdentifier The identifier of the repository to group the statistics into.
		 * @param string $objectIdentifier Unique identifier for the StatsObject. Can be any string.
		 * @param int $objectTypeID The identifier for the type of StatsObject.
		 * @param int $objectCollectionID The identifier of the group within the repository.
		 * @param string $channelIdentifier The identifier of the application from where the statistics comes from.
		 * @param int $channelTypeID The identifier of for the type of channel.
		 * @param int $eventTypeID The identifier of the type of event that resulted in the statistics.
		 * @param string $objectTitle An optional title for the StatsObject. Only set first time StatsObject/Set is called with a new ObjectIdentifier.
		 * @param string $ip IP address of end user.
		 * @param string $city Cityname of end user.
		 * @param string $country Country of end user.
		 * @param int $userSessionID Identifier for the user session, returned the call for subsequent use.
		 * @return \CHAOS\Portal\Client\Data\ServiceResult
		 */
		public function Set($repositoryIdentifier, $objectIdentifier, $objectTypeID, $objectCollectionID, $channelIdentifier, $channelTypeID, $eventTypeID, $objectTitle, $ip, $city, $country, $userSessionID);
	}
?>