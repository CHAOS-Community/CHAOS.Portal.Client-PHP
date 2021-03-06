<?php
namespace CHAOS\Portal\Client\Data;
/**
 * This class can be wrapped around each element of the MCM->Results() array,
 * if more common functionalities are wanted.
 * This class defines high abstraction methods common across use-cases for
 * a CHAOS Object, such as:
 *  - Extraction of metadata values, from a schema and an xpath expression.
 *  - Extraction of metadata values, from a list for schemas and xpath
 *    expressions - in priority. (If the exact schema is unknown)
 * @author Kræn Hansen (kraen@opensourceshift.com)
 */
libxml_set_external_entity_loader(array('CHAOS\Portal\Client\Data\DataObject', 'set_external_entities'));
class DataObject
{
	/**
	 * The object returned from CHAOS.
	 * @var stdClass
	 */
	protected $_object;

	/**
	 * Create a wrapper that wraps an object from CHAOS.
	 * @param \stdClass $object
	 */
	public function __construct(\stdClass $object) {
		$this->_object = $object;
	}

	public function __get($name) {
		return $this->_object->$name;
	}

	public function __set($name, $value) {
		$this->_object->$name = $value;
	}

	public function getObject() {
		return $this->_object;
	}

	/**
	 * An array holding the $prefix -> $ns.
	 * @var string[string]
	 */
	protected static $xml_namespaces = array();

	/**
	 * Register a namespace to use when initializing SimpleXMLDocuments.
	 * @param string $prefix The prefix that the namespace should be registered under.
	 * @param string $ns The URI of the namespace to register.
	 */
	public static function registerXMLNamespace($prefix, $ns, $location = null) {
		self::$xml_namespaces[$prefix] = array($ns, $location);
	}

	/**
	 * Loads external entities with location
	 */
	public static function set_external_entities($public, $system, $context) {
		// Only if we have a location for the external entity, we are using this function.
        if (!isset(self::$xml_namespaces[$system]) || count(self::$xml_namespaces[$system]) < 2) {
        	return;
        }
        $path = implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), "../../../../../../../../../..", strval(self::$xml_namespaces[$system][1])));

        if (!file_exists($path)) {
        	echo "error";
        	throw new \InvalidArgumentException('File does not exist.');
        }

        $f = fopen($path, 'r+');
        rewind($f);
        return $f;
    }

	/**
	 * Returns the first match of occurance of $xpath in a metadata blob complient with the schema of GUID = $schema_guid.
	 * @param string|string[] $schema_guids GUID(s) for schemas to search in.
	 * @param string|string[] $xpaths XPath expression(s) to search for.
	 * @param string $seperator If multiple matches are found, what seperator should concatinate the results? (default = ', ')
	 * 							If $seperator == null, an array is returned instead.
	 * @throws \InvalidArgumentException If $schema_guids or $xpaths are not both arrays of equal size or strings.
	 * @return string|stdClass[]|NULL A string concatinated with $seperator, an array of matches or NULL if nothing was found.
	 */
	public function metadata($schema_guids, $xpaths, $seperator = ', ') {
		if(is_string($schema_guids)) {
			$schema_guids = array($schema_guids);
		} elseif(!is_array($schema_guids)) {
			throw new \InvalidArgumentException('The $schema_guids argument should be a string or an array.');
		}

		if(is_string($xpaths)) {
			$xpaths = array($xpaths);
		} elseif(!is_array($xpaths)) {
			throw new \InvalidArgumentException('The $xpaths argument should be a string or an array.');
		}

		if(count($schema_guids) != count($xpaths)) {
			throw new \InvalidArgumentException('The cardinality of the $schema_guids and $xpaths arguments should be equal.');
		}

		for($i = 0; $i < count($schema_guids); $i++) {
			$value = $this->get_metadata($schema_guids[$i], $xpaths[$i], $seperator);
			if(isset($value)) {
				return $value;
			}
		}
		return null;
	}

	// TODO: Consider having this in the database / memory.
	static $metadata_schemas = array();

	public static function validate_metadata(\CHAOS\Portal\Client\PortalClient $client, \SimpleXMLElement $metadata, $metadata_schema_guid) {
		if(!array_key_exists(strtolower($metadata_schema_guid), self::$metadata_schemas)) {
			// Download the schema to the local cache.
			$response = $client->MetadataSchema()->Get($metadata_schema_guid);
			$result = $response->MCM()->Results();
			if(count($result) < 1) {
				throw new \CHAOSException("The metadata schema GUID ($metadata_schema_guid) was unknown to CHAOS (maybe the session has no access to the metadata schema)");
			}
			self::$metadata_schemas[$metadata_schema_guid] = strval($result[0]->SchemaXML);
		}
		$metadata_scehma = self::$metadata_schemas[$metadata_schema_guid];
		$metadata = dom_import_simplexml($metadata)->ownerDocument;
		return $metadata->schemaValidateSource($metadata_scehma);
	}

	/**
	 * A cache for parsed XML strings, keyed by the GUID of the metadata schema.
	 * @var \SimpleXMLElement[string]
	 */
	protected $xml_cache = array();

	/**
	 * Returns occurances of $xpath in a metadata blob complient with the schema of GUID = $schema_guid.
	 * @param string $schema_guid GUID for schema to search in.
	 * @param string $xpath XPath expression to search for.
	 * @param string $seperator If multiple matches are found, what seperator should concatinate the results? (default = ', ')
	 * 							If $seperator == null, an array is returned instead.
	 * @throws \RuntimeException If a namespace couldn't be registered.
	 * @return NULL|string|stdClass[]|SimpleXMLElement A string concatinated with $seperator, an array of matches or NULL if nothing was found.
	 *         or a SimpleXMLElement of the whole metadata blob if $xpath was not sat.
	 */
	public function get_metadata($schema_guid, $xpath = null, $seperator = ', ') {
		if($xpath) {
			$metadata = $this->get_metadata($schema_guid);
			if(!($metadata instanceof \SimpleXMLElement)) {
				return null;
			}
			$node = $metadata->xpath($xpath);
			if(count($node) == 0) {
				return null;
			} else {
				$result = array();
				foreach($node as $n) {
					if($seperator == null) {
						$result[] = $n;
					} else {
						$temp = '';
						foreach(dom_import_simplexml($n)->childNodes as $child) {
							 $temp .= $child->ownerDocument->saveXML($child);
						}
						$result[] = $temp;
					}
				}
				if($seperator == null) {
					return $result;
				} else {
					return implode($seperator, $result);
				}
			}
		} else {
			$schema_guid = strtolower($schema_guid);
			if(isset($this->_object->Metadatas)) {
				foreach($this->_object->Metadatas as $metadata) {
					if(strtolower($metadata->MetadataSchemaGUID) == $schema_guid) {
						if(!array_key_exists($schema_guid, $this->xml_cache)) {
							$this->xml_cache[$schema_guid] = simplexml_load_string($metadata->MetadataXML);
							foreach(self::$xml_namespaces as $prefix => $ns) {
								if(!$this->xml_cache[$schema_guid]->registerXPathNamespace($prefix, $ns[0])) {
									throw new \RuntimeException("Failed to register namespace $ns at $prefix.");
								}
							}
						}
						return $this->xml_cache[$schema_guid];
					}
				}
			}
		}
		return null;
	}

	public function get_metadata_revision_id($schema_guid) {
		$schema_guid = strtolower($schema_guid);
		if(isset($this->_object->Metadatas)) {
			foreach($this->_object->Metadatas as $metadata) {
				if(strtolower($metadata->MetadataSchemaGUID) == $schema_guid) {
					return $metadata->RevisionID;
				}
			}
		}
		return null;
	}

	/**
	 * Sets the metadata of an object on a specific schema, validating it first.
	 * @param \CHAOS\Portal\Client\PortalClient $client The PortalCliet to use when communicating with CHAOS.
	 * @param string $schema_guid The GUID of the Metadata Schema that the metadata supposingly validates successfully against.
	 * @param \SimpleXMLElement $xml The metadata XML to insert into the service.
	 * @param unknown $languageCode The language of the data in the XML schema.
	 * @param string|null $revisionID The revision - to prevent race conditions.
	 * @param  boolean $refresh_object
	 * @return \CHAOS\Portal\Client\Data\ServiceResult|boolean Either a result if the validation succeded, false if the validation fails.
	 */
	public function set_metadata(\CHAOS\Portal\Client\PortalClient $client, $schema_guid, \SimpleXMLElement $xml, $languageCode, $revisionID = null, $refresh_object = true) {
		if($revisionID == null) {
			$revisionID = $this->get_metadata_revision_id($schema_guid);
		}
		if(self::validate_metadata($client, $xml, $schema_guid)) {
			$success = $client->Metadata()->Set($this->GUID, $schema_guid, $languageCode, $revisionID, $xml->asXML());
			if($refresh_object) {
				$this->refresh($client);
			}
			return $success;
		} else {
			return false;
		}
	}

	public function has_metadata($schema_guid) {
		foreach($this->_object->Metadatas as $metadata) {
			if(strtolower($metadata->MetadataSchemaGUID) == $schema_guid) {
				return $metadata;
			}
		}
		return false;
	}

	/**
	 * Fetches an updated version of the CHAOS object from the webservice and invalidates all caches.
	 * @param \CHAOS\Portal\Client\PortalClient $client The PortalCliet to use when communicating with CHAOS.
	 */
	public function refresh(\CHAOS\Portal\Client\PortalClient $client) {
		$response = $client->Object()->Get($this->_object->GUID, null, null, 0, 1, true, true, true, true);
		if($response->MCM()->TotalCount() != 1) {
			throw new \RuntimeException('Woups! Error updating object from web service, ' . $response->MCM()->TotalCount() . ' objects returned.');
		}
		$results = $response->MCM()->Results();
		$this->_object = $results[0];
	}
}
?>
