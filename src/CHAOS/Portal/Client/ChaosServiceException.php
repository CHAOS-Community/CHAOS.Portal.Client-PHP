<?php

namespace CHAOS\Portal\Client;
class ChaosServiceException extends \RuntimeException {

	/**
	 * The original error returned from the service.
	 * @var \CHAOS\Portal\Client\Data\ServiceError
	 */
	protected $_error = null;

	/**
	 * Get the original service error.
	 * @return \CHAOS\Portal\Client\Data\ServiceError
	 */
	public function getError() {
		return $this->_error;
	}

	public function __construct(\CHAOS\Portal\Client\Data\ServiceError $error) {
		parent::__construct($error->Message());
		$this->_error = $error;
	}
}
