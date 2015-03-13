<?php
namespace Light\System\Configuration;

use Light\File\Parser\ParserInterface;

/**
 * Interface ConfigurationInterface
 * @package Light\System\Configuration
 */
interface ConfigurationInterface {

	/**
	 * @param ParserInterface $parser
	 * @return mixed
	 */
	public function setFile( ParserInterface $parser );

	/**
	 * Read the configuration and execute
	 * @return mixed
	 */
	public function execute();
} 