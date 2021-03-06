<?php
namespace Light\Dependency;
use Light\Dependency\AwareContainer\ContainerInterface;
use Light\Dependency\Injection\InjectionInterface;

/**
 * Interface Dependency
 * @package Light\Dependency
 */
interface DependencyInterface {
	/**
	 * Sets the Injection manager
	 * @param InjectionInterface $injectionInterface
	 * @return mixed
	 */
	public function setInjection( InjectionInterface $injectionInterface );

	/**
	 * @return InjectionInterface
	 */
	public function getInjection();

	/**
	 * Aware container for aware interfaces instances
	 * @param ContainerInterface $container
	 * @return mixed
	 */
	public function setAwareContainer( ContainerInterface $container );

	/**
	 * Return the Aware Container
	 * @return ContainerInterface
	 */
	public function getAwareContainer();

	/**
	 * Sets a instance
	 * @param $name
	 * @param $instance
	 * @return mixed
	 */
	public function set( $name, $instance );

	/**
	 * Gets the requested instance
	 * @param $name string
	 * @return mixed
	 */
	public function get( $name );

	/**
	 * Returns true if the dependency exists
	 * @param $name string
	 * @return mixed
	 */
	public function has( $name );
} 