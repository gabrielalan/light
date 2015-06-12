<?php
namespace Light\View;

abstract class View implements ViewInterface {
	/**
	 * Properties sended to the template
	 * @var array
	 */
	private $properties = array();

	/**
	 * @var string
	 */
	private $template = 'default.html';

	/**
	 * @param $path
	 * @return void
	 */
	public function setTemplate( $path ) {
		$this->template = $path;
	}

	/**
	 * @return string
	 */
	public function getTemplate() {
		return $this->template;
	}

	public function __set( $name, $value ) {
		$this->properties[$name] = $value;
	}

	public function __get( $name ) {
		return isset( $this->properties[$name] ) ? $this->properties[$name] : null;
	}

	/**
	 * Render the view and returns the html
	 * @return string
	 */
	abstract public function render();
} 