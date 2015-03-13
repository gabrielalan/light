<?php
namespace Light\System\Configuration;

class LightConfigurator extends Configuration {

	public function readNamespaces() {
		foreach( $this->getFile()->namespaces as $namespace ) {
			$this->getManager()->get('Light\System\Loader')->addNamespace( $namespace->namespace, realpath($namespace->baseDir) );
		}
	}

	/**
	 * Read the configuration and execute
	 * @return mixed
	 */
	public function execute() {
		$this->readNamespaces();
	}
} 