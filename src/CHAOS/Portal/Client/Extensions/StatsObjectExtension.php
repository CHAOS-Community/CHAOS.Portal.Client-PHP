<?php
	namespace CHAOS\Portal\Client\Extensions;
	use \CHAOS\Portal\Client\IServiceCaller;

	class StatsObjectExtension extends AExtension implements IStatsObjectExtension
	{
		public function Set($repositoryIdentifier, $objectIdentifier, $objectTypeID, $objectCollectionID, $channelIdentifier, $channelTypeID, $eventTypeID, $objectTitle, $ip, $city, $country, $userSessionID)
		{
			return $this->CallService("Set", IServiceCaller::GET, array("repositoryIdentifier" => $repositoryIdentifier,
																		"objectIdentifier" => $objectIdentifier,
																		"objectTypeID" => $objectTypeID,
																		"objectCollectionID" => $objectCollectionID,
																		"channelIdentifier" => $channelIdentifier,
																		"channelTypeID" => $channelTypeID,
																		"eventTypeID" => $eventTypeID,
																		"objectTitle" => $objectTitle,
																		"IP" => $ip,
																		"city" => $city,
																		"country" => $country,
																		"userSessionID" => $userSessionID));
		}
	}
?>