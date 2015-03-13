<?php
namespace Light\System\Configuration;

class LightConfigurator extends Configuration {

	protected function readNamespaces() {
		$file = $this->getFile();

		if( !$file->namespaces )
			return false;

		foreach( $this->getFile()->namespaces as $namespace ) {
			$this->getManager()->get('Light\System\Loader')->addNamespace( $namespace->namespace, realpath($namespace->baseDir) );
		}
	}

	protected function readControllers() {
		$file = $this->getFile();

		if( !$file->controllers )
			return false;

		var_dump($file->controllers);
	}

	/**
	 * Read the configuration and execute
	 * @return mixed
	 */
	public function execute() {
		$this->readNamespaces();
		$this->readControllers();
	}
} 