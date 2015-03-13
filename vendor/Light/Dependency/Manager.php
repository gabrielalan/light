<?php
namespace Light\Dependency;

use Light\Dependency\Exceptions\DependencyNotFound;

class Manager extends Dependency {
	/**
	 * Dependencies
	 * @var array
	 */
	protected $instances = array();

	public function __construct() {
		$this->set('Light\Dependency\Manager', $this);
		$this->getAwareContainer()->add( 'Light\Dependency\ManagerAwareInterface', 'Light\Dependency\Manager');
	}

	/**
	 * Sets a dependency
	 * @param $name
	 * @param $instance
	 * @return mixed|void
	 */
	public function set( $name, $instance ) {
		$this->getAwareContainer()->inject($instance);
		$this->instances[$name] = $instance;
	}

	/**
	 * Gets a instance of a dependency
	 * @param string $instance
	 * @return mixed
	 * @throws DependencyNotFound
	 */
	public function get( $instance ) {
		if( !isset( $this->instances[$instance] ) )
			throw new DependencyNotFound("The dependency {$instance} can not be found");

		return is_callable($this->instances[$instance]) ? $this->instances[$instance]() : $this->instances[$instance];
	}
} 