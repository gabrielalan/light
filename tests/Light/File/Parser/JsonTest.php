<?php

namespace Light\File\Parser;

class JsonTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @expectedException Light\File\Parser\Exceptions\FileNotFoundException
	 */
	public function testFileNotFoundException() {
		$exception = new Json('not_found.json');
	}

	public function testJson() {
		$json = new Json('Application/Config/application.json');

		$this->assertContains('Application\Config\application.json', $json->getPath());

		$this->assertInstanceOf('Light\File\Parser\Json', $json);

		$json->parse();

		$this->assertEquals(true, $json->isParsed());
	}
}
 