<?php
namespace Light\System\Configuration;

use Light\File\Parser\ParserInterface;
use Light\System\Configuration\Part\PartInterface;

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
	 * @return ParserInterface
	 */
	public function getFile();

	/**
	 * @param $key
	 * @param $value
	 * @return mixed
	 */
	public function set($key, $value);

	/**
	 * @param $key
	 * @return mixed
	 */
	public function get($key);

	/**
	 * @param PartInterface $part
	 * @return mixed
	 */
	public function addPart( PartInterface $part );

	/**
	 * Read the configuration and execute
	 * @return mixed
	 */
	public function execute();
} 