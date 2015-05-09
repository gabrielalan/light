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
		if( !is_callable($instance) ) {
			$this->getAwareContainer()->inject($instance);
		} else {
			$instance = function() use($instance) {
				$object = $instance();
				$this->getAwareContainer()->inject($object);
				return $object;
			};
		}

		$this->store($name, $instance);
	}

	/**
	 * Alias to store the instance (or callable)
	 * @param $name
	 * @param $instance
	 */
	protected function store( $name, $instance ) {
		$this->instances[ $name ] = $instance;
	}

	/**
	 * Gets a instance of a dependency
	 * @param string $name
	 * @return mixed
	 * @throws DependencyNotFound
	 */
	public function get( $name ) {
		if( !isset( $this->instances[$name] ) )
			throw new DependencyNotFound("The dependency {$name} can not be found");

		if( is_callable($this->instances[$name]) ) {
			$instance = $this->instances[$name]();
			$this->store($name, $instance);
		}

		return $this->instances[$name];
	}
} 