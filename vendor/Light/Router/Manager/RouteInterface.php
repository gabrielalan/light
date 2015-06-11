<?php

namespace Light\Router\Manager;

/**
 * Interface for every route of the system
 * @package Light\Router
 */
interface RouteInterface {

	public function getUri();

	public function getController();

	public function setMatches( $matches );

	/**
	 * Execute the controller if the URI matches
	 * @return void
	 */
	public function execute();
} 