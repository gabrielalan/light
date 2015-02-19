<?php
namespace Light\Dependency\Injection;

use Light\Dependency\DependencyInterface;

interface InjectionInterface {

	/**
	 * @param $class
	 * @param array $params
	 * @internal param \ReflectionClass $reflectionClass
	 * @return mixed
	 */
	public function mergeParams( $class, array $params );

	/**
	 * @param $class
	 * @return \ReflectionClass
	 */
	public function getReflectionClass( $class );

	/**
	 * Injects the Dependency Manager
	 * @param DependencyInterface $dependency
	 * @return mixed
	 */
	public function setManager( DependencyInterface $dependency );
} 