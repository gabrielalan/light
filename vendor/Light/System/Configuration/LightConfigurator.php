<?php
namespace Light\System\Configuration;

use Light\System\Configuration\Part\Namespaces;
use Light\System\Configuration\Part\Routes;
use Light\System\Configuration\Part\Views;

class LightConfigurator extends Configuration {

	public function __construct( $parser = null ) {
		parent::__construct($parser);

		$this->addPart(new Namespaces());
		$this->addPart(new Views());
		$this->addPart(new Routes());
	}

	/**
	 * Read the configuration and execute
	 * @return mixed
	 */
	public function execute() {
		$parts = $this->getParts();

		foreach( $parts as $part ) {
			$part->execute();
		}
	}
} 