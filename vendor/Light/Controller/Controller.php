<?php
namespace Light\Controller;

use Light\View\ViewInterface;

abstract class Controller implements ControllerInterface {
	/**
	 * @var ViewInterface
	 */
	private $view;

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