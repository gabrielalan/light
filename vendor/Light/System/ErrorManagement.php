<?php
namespace Light\System;

use Light\Controller\ControllerInterface;
use Light\Dependency\Manager;
use Light\Dependency\ManagerAwareInterface;

class ErrorManagement implements ManagerAwareInterface {

	/**
	 * @var \Exception
	 */
	protected $exception;

	/**
	 * @var Manager
	 */
	protected $manager;

	public function __construct( \Exception $exception ) {
		$this->exception = $exception;
	}

	/**
	 * Start
	 */
	public function manage() {
		try {
			$controller = $this->manager->get('Light\Controller\Error');

			$this->manager->set('CurrentError', $this->exception);

			$this->runController( $controller );
		} catch( \Exception $ex ) {
			$this->dump();
		}
	}

	/**
	 * @param ControllerInterface $controller
	 */
	protected function runController( ControllerInterface $controller ) {
		$reflection = new \ReflectionClass($controller);
		$method = $reflection->getMethod('index');
		$controller->run( $method );
	}

	protected function dump() {
		if( isset( $this->exception->xdebug_message ) ) {
			echo '<pre>' . $this->exception->xdebug_message . '</pre>';
		} else {
			var_dump($this->exception);
		}
	}

	/**
	 * Setter
	 * @param Manager $manager
	 * @return mixed
	 */
	public function setManager(Manager $manager) {
		$this->manager = $manager;
	}
} 