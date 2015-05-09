<?php
namespace Light\System\Configuration;

use Light\Dependency\Exceptions\DependencyNotFound;
use Light\Router\Manager;

class LightConfigurator extends Configuration {

	protected function readNamespaces() {
		$file = $this->getFile();

		if( !$file->namespaces )
			return false;

		foreach( $file->namespaces as $namespace ) {
			$this->getManager()->get('Light\System\Loader')->addNamespace( $namespace->namespace, realpath($namespace->baseDir) );
		}
	}

	protected function readRouter() {
		$file = $this->getFile();

		$router = $this->getRouterManager();

		if( !$file->router )
			return false;

		foreach( $file->router as $uri => $controllerName ) {
			$controller = preg_replace('/\//i', '\\', $controllerName);
			$this->getManager()->set($controller, function() use($controller) { return new $controller(); });
			$router->addRoute($uri, $controller);
		}
	}

	/**
	 * Returns the Router/Manager
	 * @return Manager
	 */
	protected function getRouterManager() {
		$manager = $this->getManager();

		try {
			$router = $manager->get('Light\Router\Manager', '\Light\Router\ManagerInterface');
		} catch( DependencyNotFound $exception ) {
			$router = new Manager();
			$manager->set('Light\Router\Manager', $router);
		}

		return $router;
	}

	/**
	 * Read the configuration and execute
	 * @return mixed
	 */
	public function execute() {
		$this->readNamespaces();
		$this->readRouter();
	}
} 