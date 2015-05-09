<?php

namespace Light\Router\Manager;

use Light\Dependency\Manager;
use Light\Dependency\ManagerAwareInterface;

class Route implements RouteInterface, ManagerAwareInterface {

	protected $uri;

	protected $controller;

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

	/**
	 * Execute the controller if the URI matches
	 * @return void
	 */
	public function execute() {
		var_dump($this->manager->get($this->getController()));
	}

	public function getUri() {
		return $this->uri;
	}

	public function getController() {
		return $this->controller;
	}
}