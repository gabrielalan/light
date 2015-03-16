<?php
namespace Light\Controller;

use Light\Dependency\Manager;
use Light\Dependency\ManagerAwareInterface;
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
	 * Setter
	 * @param Manager $manager
	 * @return mixed
	 */
	public final function setManager(Manager $manager) {
		$this->manager = $manager;
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
	 * @return mixed|string
	 */
	public function run() {
		return $this->getView()->render();
	}
} 