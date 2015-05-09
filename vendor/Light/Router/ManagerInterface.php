<?php

namespace Light\Router;

/**
 * Router managers must implement the control
 * for the system routes.
 * @package Light\Router
 */
interface ManagerInterface {

	/**
	 * @param $route
	 * @param $controller
	 * @return mixed
	 */
	public function addRoute( $route, $controller );

	/**
	 * Dispatch the correct route
	 * @return mixed
	 */
	public function dispatch();
}