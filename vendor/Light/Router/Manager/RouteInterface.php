<?php

namespace Light\Router\Manager;

/**
 * Interface for every route of the system
 * @package Light\Router
 */
interface RouteInterface {

	public function getUri();

	public function getController();

	/**
	 * The match method, verifys if the route match
	 * with current URI
	 * @return boolean
	public function test();
	 */

	/**
	 * Execute the controller if the URI matches
	 * @return void
	 */
	public function execute();
} 