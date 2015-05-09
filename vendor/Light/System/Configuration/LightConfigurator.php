<?php
namespace Light\System\Configuration;

class LightConfigurator extends Configuration {

	protected function readNamespaces() {
		$file = $this->getFile();

		if( !$file->namespaces )
			return false;

		foreach( $file->namespaces as $namespace ) {
			$this->getManager()->get('Light\System\Loader')->addNamespace( $namespace->namespace, realpath($namespace->baseDir) );
		}
	}

	protected function readControllers() {
		$file = $this->getFile();

		if( !$file->controllers )
			return false;

		$n = preg_replace('/\//i', '\\', $file->controllers->{'Application/Controller/Index'});

		var_dump($this->getManager());
		$this->getManager()->set('Application\Controller\Index', function() use($n) { return new $n(); });
		var_dump($this->getManager()->get('Application\Controller\Index'));
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