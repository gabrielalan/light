<?php
namespace Light\System\Configuration;

use Light\Dependency\Manager;
use Light\Dependency\ManagerAwareInterface;
use Light\File\Parser\ParserInterface;
use Light\System\Configuration\Part\PartInterface;

/**
 * Class Configuration
 * @package Light\System\Configuration
 */
abstract class Configuration implements ConfigurationInterface, ManagerAwareInterface {
	/**
	 * @var ParserInterface
	 */
	private $file;

	/**
	 * @var Manager
	 */
	private $manager;

	/**
	 * Configiration Parts
	 * @var PartCollection
	 */
	protected $parts;

	/**
	 * @var array
	 */
	protected $properties = array();

	public function __construct( $parser = null ) {
		$this->parts = new PartCollection();

		if( $parser )
			$this->setFile($parser);
	}

	/**
	 * @param PartInterface $part
	 * @return mixed
	 */
	public function addPart(PartInterface $part) {
		$part->setConfiguration($this);
		$this->parts->append($part);
	}

	/**
	 * @return PartCollection
	 */
	public function getParts() {
		return $this->parts;
	}

	/**
	 * Setter
	 * @param Manager $manager
	 * @return mixed
	 */
	public function setManager(Manager $manager) {
		$this->manager = $manager;
	}

	/**
	 * @return Manager
	 */
	public function getManager() {
		return $this->manager;
	}

	/**
	 * @param ParserInterface $parser
	 * @return mixed|void
	 */
	public function setFile( ParserInterface $parser ) {
		$parser->parse();
		$this->file = $parser;
	}

	/**
	 * @return ParserInterface
	 */
	public function getFile() {
		return $this->file;
	}

	/**
	 * @param $key
	 * @param $value
	 * @return mixed
	 */
	public function set($key, $value) {
		$this->properties[$key] = $value;
	}

	/**
	 * @param $key
	 * @return mixed
	 */
	public function get($key) {
		return isset( $this->properties[$key] ) ? $this->properties[$key] : null;
	}
} 