<?php
namespace Light\Dependency;

use Light\Dependency\Exceptions\DependencyNotFound;
use Light\Dependency\Exceptions\WrongInterface;

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

	protected function makeStringCallable( $className ) {
		$closure = function() use($className) {
			$ref = new \ReflectionClass($className);
			$dependencies = $this->getAwareContainer()->getConstructorDependencies( $ref );
			$instance = $ref->newInstanceArgs($dependencies);
			return $instance;
		};

		return $closure;
	}

	/**
	 * Sets a dependency
	 * @param $name
	 * @param $instance
	 * @return mixed|void
	 */
	public function set( $name, $instance ) {

		if( is_string($instance) ) {
			$instance = $this->makeStringCallable($instance);
		} else if( !is_callable($instance) ) {
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
	 * Returns true if the dependency exists
	 * @param string $name
	 * @return bool|mixed
	 */
	public function has( $name ) {
		return isset( $this->instances[ $name ] );
	}

	/**
	 * Gets a instance of a dependency
	 * @param string $name
	 * @param string $compare
	 * @throws DependencyNotFound
	 * @throws WrongInterface
	 * @return mixed
	 */
	public function get( $name, $compare = null ) {
		if( !isset( $this->instances[$name] ) ) {
			throw new DependencyNotFound("The dependency {$name} can not be found");
		}

		$instance = $this->instances[$name];

		if( is_callable($instance) ) {
			$instance = $this->instances[$name]();
			$this->store($name, $instance);
		}

		if( !empty($compare) && !$this->compare($instance, $compare) ) {
			throw new WrongInterface("The instance {$name} do not implement the interface '{$compare}'");
		}

		return $this->instances[$name];
	}

	/**
	 * Compare the instance with a interface ou parent classes
	 * @param $instance
	 * @param $name
	 * @return bool
	 */
	protected function compare( $instance, $name ) {
		$reflection = new \ReflectionClass($instance);

		if( $reflection->isSubclassOf($name) || $reflection->implementsInterface($name) )
			return true;

		return false;
	}
} 