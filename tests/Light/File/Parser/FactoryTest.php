<?php

namespace Light\File\Parser;

class FactoryTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Light\File\Parser\Exceptions\ParserNotFoundException
	 */
	public function testParserNotFoundException() {
		$parserNotFound = Factory::createByType('notFoundFile.AAA');
	}

	/**
	 * @expectedException Light\File\Parser\Exceptions\FileNotFoundException
	 */
	public function testFileNotFoundException() {
		$parserNotFound = Factory::createByType('notFoundFile.json');
	}

	public function testSuccess() {
		$parser = Factory::createByType('Application/Config/application.json');

		$this->assertInstanceOf('Light\File\Parser\Json', $parser);
	}
}
 