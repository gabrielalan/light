<?php
namespace Light\Pattern;

/**
 * Singleton Pattern
 * @package Pattern
 */
abstract class Singleton {
	/**
	 * Instance
	 * @var Singleton
	 */
	protected static $instance;

	/**
	 * Protected constructor to block public instantiate
	 */
	protected function __construct() {}

	/**
	 * Get instance
	 * @return Singleton
	 */
	public final static function getInstance() {
		if( null === static::$instance )
			static::$instance = new static();

		return static::$instance;
	}
} 