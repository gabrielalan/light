<?php
namespace Light\System\Configuration;

use Light\Dependency\Manager;
use Light\Dependency\ManagerAwareInterface;
use Light\File\Parser\ParserInterface;

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

	public function __construct( $parser = null ) {
		if( $parser )
			$this->setFile($parser);
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
} 