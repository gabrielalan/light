<?php
namespace Light\Controller;

use Light\Dependency\Manager;
use Light\Dependency\ManagerAwareInterface;
use Light\Server\ResponseAwareInterface;
use Light\Server\ResponseInterface;
use Light\View\ViewInterface;

abstract class Controller implements ControllerInterface, ManagerAwareInterface {
	/**
	 * @var ViewInterface
	 */
	private $view;
	/**
	 * @var Manager
	 */
	private $manager;

	/**
	 * @var ResponseInterface
	 */
	private $response;

	/**
	 * Setter
	 * @param Manager $manager
	 * @return mixed
	 */
	public final function setManager(Manager $manager) {
		$this->manager = $manager;
	}

	/**
	 * Setter of the response
	 *
	 * @param ResponseInterface $response
	 * @return mixed
	 */
	public function setResponse(ResponseInterface $response) {
		$this->response = $response;
	}

	/**
	 * @return ResponseInterface
	 */
	public function getResponse() {
		return $this->response;
	}

	/**
	 * @return Manager
	 */
	public final function getManager() {
		return $this->manager;
	}

	/**
	 * Sets the view
	 * @param ViewInterface $view
	 * @return mixed
	 */
	public function setView(ViewInterface $view) {
		$this->view = $view;
	}

	/**
	 * Get the view
	 * @return ViewInterface
	 */
	public function getView() {
		return $this->view;
	}

	/**
	 * Run the controller view
	 * @param \ReflectionMethod $action
	 * @return mixed|string
	 */
	public function run( \ReflectionMethod $action ) {
		$action->invoke($this);
		return $this->getView()->render();
	}
} 