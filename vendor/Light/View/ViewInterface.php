<?php

namespace Light\View;

interface ViewInterface {
	/**
	 * Set the template used by the view
	 * @param $path
	 * @return mixed
	 */
	public function setTemplate( $path );

	/**
	 * Render the view and returns the html
	 * @return string
	 */
	public function render();
} 