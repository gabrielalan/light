<?php
namespace Light\File\Parser;

use Light\File\Parser\Exceptions\FileNotFoundException;

abstract class Parser implements ParserInterface {
	/**
	 * Path of the file
	 * @var string
	 */
	protected $path;

	/**
	 * Parse data
	 * @var \stdClass
	 */
	private $parsed;

	/**
	 * @param $path string Path of the file
	 */
	public function __construct( $path ) {
		$this->setPath($path);
	}

	/**
	 * @param \stdClass $parsed
	 */
	protected function setParsed( \stdClass $parsed) {
		$this->parsed = $parsed;
	}

	/**
	 * Return true if the file is already parsed
	 * @return boolean
	 */
	public function isParsed() {
		return $this->parsed !== null;
	}

	/**
	 * Return a property of instance or parsed data
	 * @param $name
	 * @return null
	 */
	public function __get($name) {
		if( isset( $this->$name ) )
			return $this->$name;

		return isset( $this->parsed->$name ) ? $this->parsed->$name : null;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * @param $path
	 * @throws FileNotFoundException
	 */
	public function setPath( $path )	{
		$this->path = realpath($path);

		if( !file_exists($this->getPath()) )
			throw new FileNotFoundException('The file "' . $this->path . '" does not exist');
	}
}