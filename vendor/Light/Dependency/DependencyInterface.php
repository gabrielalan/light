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
	 * Sets a instance
	 * @param $name
	 * @param $instance
	 * @return mixed
	 */
	public function set( $name, $instance );

	/**
	 * Gets the requested instance
	 * @param $instance string
	 * @return mixed
	 */
	public function get( $instance );
} 