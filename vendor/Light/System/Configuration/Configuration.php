<?php
namespace Light\System\Configuration;

use Light\File\Parser\ParserInterface;

/**
 * Class Configuration
 * @package Light\System\Configuration
 */
class Configuration implements ConfigurationInterface {
	/**
	 * @var ParserInterface
	 */
	private $file;

	public function __construct( $parser = null ) {
		if( $parser )
			$this->setFile($parser);
	}

	/**
	 * @param ParserInterface $parser
	 * @return mixed|void
	 */
	public function setFile( ParserInterface $parser ) {
		$this->file = $parser;
	}

	/**
	 * @return ParserInterface
	 */
	public function getFile() {
		return $this->file;
	}
} 