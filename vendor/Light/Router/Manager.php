<?php

namespace Light\Router;

use Light\Dependency\ManagerAwareInterface;
use Light\Router\Manager\Route;
use Light\Router\Manager\RouteInterface;

class Manager implements ManagerInterface, ManagerAwareInterface {
	protected $routes = array();

	/*
	 * @var \Light\Dependency\Manager
	 */
	protected $manager;

	/**
	 * Setter
	 * @param \Light\Dependency\Manager $manager
	 * @return mixed
	 */
	public function setManager(\Light\Dependency\Manager $manager) {
		$this->manager = $manager;
	}

	public function addRoute($route, $controller) {
		$route = new Route( $route, $controller );
		$this->manager->getAwareContainer()->inject($route);
		$this->storeRoute($route);
	}

	public function storeRoute( RouteInterface $route ) {
		$this->routes[] = $route;
	}

	protected function normalizeRouteUri( $uri ) {
		return '/' . preg_replace('/\//i', '\/', $uri) . '/i';
	}

	public function dispatch() {
		foreach( $this->routes as $route ) {
			$uri = $this->normalizeRouteUri($route->getUri());

			if( preg_match($uri, $_SERVER['REQUEST_URI']) ) {
				$route->execute();
				break;
			}
		}
	}
} 