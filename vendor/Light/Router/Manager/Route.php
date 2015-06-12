<?php

namespace Light\Router\Manager;

use Light\Dependency\Manager;
use Light\Dependency\ManagerAwareInterface;

class Route implements RouteInterface, ManagerAwareInterface {

	protected $uri;

	protected $controller;

	protected $matches;

	/**
	 * @var Manager
	 */
	protected $manager;

	public function __construct( $uri, $controller ) {
		$this->uri = $uri;
		$this->controller = $controller;
	}

	/**
	 * Setter
	 * @param Manager $manager
	 * @return mixed
	 */
	public function setManager(Manager $manager) {
		$this->manager = $manager;
	}

	public function setMatches( $matches ) {
		$this->matches = $matches;
	}

	/**
	 * @param \ReflectionClass $reflection
	 * @throws \Exception
	 * @return \ReflectionMethod
	 */
	protected function getAction( \ReflectionClass $reflection ) {
		$name = 'index';

		if( !empty( $this->matches['action'] ) )
			$name = $this->matches['action'];

		try {
			$method = $reflection->getMethod($name);
		} catch( \Exception $excecao ) {
			throw new \Exception("The choosen action '{$name}' does not exist on that controller");
		}

		return $method;
	}

	/**
	 * Execute the controller if the URI matches
	 * @return void
	 */
	public function execute() {
		$controller = $this->manager->get($this->getController());
		$reflection = new \ReflectionClass($controller);
		$controller->run( $this->getAction($reflection) );
	}

	public function getUri() {
		return $this->uri;
	}

	public function getController() {
		return $this->controller;
	}
}