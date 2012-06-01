<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class StatsObjectExtension extends AExtension implements IStatsObjectExtension
	{
		public function Set($repositoryIdentifier, $objectIdentifier, $objectTypeID, $objectCollectionID, $channelIdentifier, $channelTypeID, $eventTypeID, $objectTitle = null, $ip = null, $city = null, $country = null, $userSessionID = 0)
		{
			return $this->CallService("Set", IServiceCaller::GET, array("repositoryIdentifier" => $repositoryIdentifier,
																		"objectIdentifier" => $objectIdentifier,
																		"objectTypeID" => $objectTypeID,
																		"objectCollectionID" => $objectCollectionID,
																		"channelIdentifier" => $channelIdentifier,
																		"channelTypeID" => $channelTypeID,
																		"eventTypeID" => $eventTypeID,
																		"objectTitle" => $objectTitle == null ? "" : $objectTitle,
																		"IP" => $ip == null ? "" : $ip,
																		"city" => $city == null ? "" : $city,
																		"country" => $country == null ? "" : $country,
																		"userSessionID" => $userSessionID));
		}
	}
?>