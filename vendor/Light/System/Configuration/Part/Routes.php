<?php
namespace Light\System\Configuration\Part;

use Light\Dependency\Exceptions\DependencyNotFound;
use Light\Router\Manager;

class Routes extends Part {

	protected $manager;
	protected $router;

	public function execute() {
		$this->manager = $this->getConfiguration()->getManager();
		$this->router = $this->getRouterManager();

		$file = $this->getConfiguration()->getFile();

		if( !$file->router )
			return false;

		if( isset( $file->router->routes ) ) {
			$this->readRoutes($file->router->routes);
		}

		if( isset( $file->router->errorController ) ) {
			$this->addController($file->router->errorController, 'Light\Controller\Error');
		}
	}

	/**
	 * Read the routes
	 * @param $routes
	 */
	protected function readRoutes( $routes ) {
		foreach( $routes as $uri => $controllerName ) {
			$this->router->addRoute($uri, $this->addController($controllerName));
		}
	}

	/**
	 * Adds the controller to manager
	 * @param $name
	 * @param null $dependencyName
	 * @return mixed
	 */
	protected function addController( $name, $dependencyName = null ) {
		$controller = preg_replace('/\//i', '\\', $name);
		$this->manager->set( !empty($dependencyName) ? $dependencyName : $controller, function() use($controller) { return new $controller(); });
		return $controller;
	}

	/**
	 * Returns the Router/Manager
	 * @return Manager
	 */
	protected function getRouterManager() {
		try {
			$router = $this->manager->get('Light\Router\Manager', '\Light\Router\ManagerInterface');
		} catch( DependencyNotFound $exception ) {
			$router = new Manager();
			$this->manager->set('Light\Router\Manager', $router);
		}

		return $router;
	}
} 