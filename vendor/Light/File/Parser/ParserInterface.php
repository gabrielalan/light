<?php
namespace Light\File\Parser;

interface ParserInterface {

	/**
	 * Return true if the file is already parsed
	 * @return boolean
	 */
	public function isParsed();

	/**
	 * Parse the file
	 * @return mixed
	 */
	public function parse();
} 