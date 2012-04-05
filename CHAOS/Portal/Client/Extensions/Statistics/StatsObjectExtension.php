<?php
	/**
	 * Created: Jacob Poul Richardt
	 * Email: jacob@geckon.com
	 * Date: 03-04-12
	 */
	namespace CHAOS\Portal\Client\Extensions\Statistics;
	use CHAOS\Portal\Client\Extensions\AExtension;
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
																		"ip" => $ip,
																		"city" => $city,
																		"country" => $country,
																		"userSessionID" => $userSessionID));
		}
	}
?>