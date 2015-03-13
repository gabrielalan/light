<?php
namespace Light\Dependency\AwareContainer;

use Light\Dependency\AwareContainer\Exceptions\AwareAlreadyExistsException;
use Light\Dependency\AwareContainer\Exceptions\InterfaceHasNotMethodException;
use Light\Dependency\DependencyInterface;

class Container implements ContainerInterface {
	private $instances = array();

	private $manager;

	/**
	 * Injects the dependency manager for search instances
	 * @param DependencyInterface $manager
	 * @return mixed
	 */
	public function setManager(DependencyInterface $manager) {
		$this->manager = $manager;
	}

	/**
	 * Add instance of aware interface
	 * @param String $interface
	 * @param String $instance
	 * @throws AwareAlreadyExistsException
	 * @throws InterfaceHasNotMethodException
	 * @return mixed
	 */
	public function add( $interface, $instance ) {
		$reflection = new \ReflectionClass($interface);

		$method = current( $reflection->getMethods() );

		if( !$method ) {
			throw new InterfaceHasNotMethodException("The aware interface '{$interface}' has not method");
		}

		if( isset( $this->instances[$interface] ) ) {
			throw new AwareAlreadyExistsException("The aware instance '{$interface}' already exists on the container");
		}

		$this->instances[$interface] = array( 'instance' => $instance, 'method' => $method->getName() );
	}

	/**
	 * @param $interface
	 * @internal param \ReflectionClass $instance
	 * @return bool
	 */
	public function hasAwareInterface( $interface ) {
		return isset( $this->instances[ $interface ] );
	}

	public function getAwareInterface( $interface ) {
		return $this->hasAwareInterface( $interface ) ? $this->instances[ $interface ] : false;
	}

	/**
	 * Verify the instance searching aware interfaces
	 * @param $instance
	 * @return mixed
	 */
	public function inject( $instance ) {
		$reflection = new \ReflectionClass( $instance );

		foreach( $reflection->getInterfaces() as $interface ) {
			$data = $this->getAwareInterface( $interface->getName() );

			if( !$data )
				continue;

			if( $reflection->hasMethod( $data['method'] ) )
				call_user_func_array(array( $instance, $data['method'] ), array( $this->manager->get($data['instance']) ));
		}
	}
} 