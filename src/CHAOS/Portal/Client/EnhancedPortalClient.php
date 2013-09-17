<?php
/**
 * An enhanced extension of the PortalClient, could be merged into the PortalClient when this stabalizes.
 * @author Kræn Hansen for DR A&R Innovation (kh@bitblueprint.com)
 */
namespace CHAOS\Portal\Client;
class EnhancedPortalClient extends PortalClient {
	
	/**
	 * Expected service-side timeout on a CHAOS session.
	 * @var string Will be appended a '-' and used as argument for a call to the strtotime function.
	 */
	const SESSION_TIMEOUT = '18 minutes';
	
	/**
	 * An array of the methods on a \CHAOS\Portal\Client\Data\ModuleResult which is not modules.
	 * @var string[]
	 */
	protected static $NOT_MODULE_METHODS = array('WasSuccess', 'Error', 'Duration', '__construct');
	
	/**
	 * Should the session be automatically refreshed before it times out?
	 * @var bool
	 */
	protected $_autoRefreshSession;
	
	/**
	 * Should errors from the service be thrown as exceptions?
	 * @var bool
	 */
	protected $_throwExceptions;
	
	public function __construct($servicePath, $clientGUID, $autoCreateSession = true, $autoRefreshSession = true, $throwExceptions = true) {
		parent::__construct($servicePath, $clientGUID, $autoCreateSession);
		$this->_autoRefreshSession = $autoRefreshSession;
		$this->_throwExceptions = $throwExceptions;
	}

	/**
	 * (non-PHPdoc)
	 * @see \CHAOS\Portal\Client\PortalClient::CallService()
	 * @return \CHAOS\Portal\Client\Data\ServiceResult A result from the CHAOS service.
	 */
	public function CallService($path, $method, array $parameters = null, $requiresSession = true) {
		$result = parent::CallService($path, $method, $parameters, $requiresSession);
		/* @var $result \CHAOS\Portal\Client\Data\ServiceResult */
		// Should service errors be thrown as exceptions?
		if($this->_throwExceptions) {
			// Did the call itself, fail?
			if(!$result->WasSuccess()) {
				throw new ChaosServiceException($result->Error());
			}
			// Throw any error from a module as an exception.
			$modules = array_diff(get_class_methods($result), self::$NOT_MODULE_METHODS);
			foreach($modules as $module) {
				$moduleResult = $result->$module();
				if($moduleResult instanceof \CHAOS\Portal\Client\Data\ModuleResult) {
					if(!$moduleResult->WasSuccess()) {
						throw new ChaosServiceException($moduleResult->Error());
					}
				}
			}
		}
		return $result;
	}
	
	protected $_lastSessionUpdate = null;
	
	public function SessionGUID() {
		// Keep the session alive.
		$timeoutTime = strtotime('-'.self::SESSION_TIMEOUT);
		
		if($this->_lastSessionUpdate < $timeoutTime) {
			// The chaos session should be updated.
			// We have to do this to prevent endless recursion.
			$this->_lastSessionUpdate = time();
			$this->Session()->Update();
		}
		
		return parent::SessionGUID();
	}

	public function SetSessionGUID($guid, $isAuthenticated) {
		$result = parent::SetSessionGUID($guid, $isAuthenticated);
		$this->_lastSessionUpdate = time();
		return $result;
	}
}