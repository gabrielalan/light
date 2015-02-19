<?php
namespace Light\File\Parser;

use Light\File\Parser\Exceptions\ParserNotFoundException;

class Factory {

	/**
	 * @param $path
	 * @throws ParserNotFoundException
	 * @return Light\File\Parser\Parser
	 */
	public static function createByType( $path ) {
		$class = 'Light\File\Parser\\' . ucfirst( end( explode('.', $path) ) );

		if( class_exists( $class ) )
			return new $class($path);

		throw new ParserNotFoundException('No parser founded with the name ' . $class);
	}
} 