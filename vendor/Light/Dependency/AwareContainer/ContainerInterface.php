<?php
namespace Light\Dependency\AwareContainer;

use Light\Dependency\DependencyInterface;

interface ContainerInterface {

	/**
	 * Injects the dependency manager for search instances
	 * @param DependencyInterface $manager
	 * @return mixed
	 */
	public function setManager( DependencyInterface $manager );

	/**
	 * Add instance of aware interface
	 * @param $interface String
	 * @param $instance String
	 * @return mixed
	 */
	public function add( $interface, $instance );

	/**
	 * Verify the instance searching aware interfaces
	 * @param $instance
	 * @return mixed
	 */
	public function inject( $instance );

	/**
	 * This must return an array with constructor dependencies
	 * @param $instance
	 * @return array
	 */
	public function getConstructorDependencies( $instance );
} 