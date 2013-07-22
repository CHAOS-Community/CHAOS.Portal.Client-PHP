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
class Object
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
	
	/**
	 * Returns the object given when constructed.
	 * @return stdClass
	 */
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
	public static function registerXMLNamespace($prefix, $ns) {
		self::$xml_namespaces[$prefix] = $ns;
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
			$value = $this->get_metadata($schema_guids[$i], $xpaths[$i]);
			if(isset($value)) {
				return $value;
			}
		}
		return null;
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
	 * @return NULL|string|stdClass[] A string concatinated with $seperator, an array of matches or NULL if nothing was found.
	 */
	protected function get_metadata($schema_guid, $xpath, $seperator = ', ') {
		$schema_guid = strtolower($schema_guid);
		foreach($this->_object->Metadatas as $metadata) {
			if(strtolower($metadata->MetadataSchemaGUID) == $schema_guid) {
				if(!array_key_exists($schema_guid, $this->xml_cache)) {
					$this->xml_cache[$schema_guid] = simplexml_load_string($metadata->MetadataXML);
					foreach(self::$xml_namespaces as $prefix => $ns) {
						if(!$this->xml_cache[$schema_guid]->registerXPathNamespace($prefix, $ns)) {
							throw new \RuntimeException("Failed to register namespace $ns at $prefix.");
						}
					}
				}
				$node = $this->xml_cache[$schema_guid]->xpath($xpath);
				if(count($node) == 0) {
					return null;
				} elseif(isset($seperator)) {
					return implode($seperator, $node);
				} else {
					return $node;
				}
			}
		}
	}
	
	public function has_metadata($schema_guid) {
		$schema_guid = strtolower($schema_guid);
		foreach($this->_object->Metadatas as $metadata) {
			if(strtolower($metadata->MetadataSchemaGUID) == $schema_guid) {
				return true;
			}
		}
		return false;
	}
}
?>