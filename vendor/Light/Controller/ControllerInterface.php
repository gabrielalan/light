<?php

namespace Light\Controller;

use Light\View\ViewInterface;

interface ControllerInterface {
	/**
	 * Sets the view
	 * @param ViewInterface $view
	 * @return mixed
	 */
	public function setView( ViewInterface $view );

	/**
	 * Executes the Controller Action and commands
	 * @param \ReflectionMethod $action
	 * @return mixed
	 */
	public function run( \ReflectionMethod $action );
} 