<?php
namespace Light\Dependency\Injection;

use Light\Dependency\DependencyInterface;
use Light\Dependency\Injection\Exceptions\ClassNotFoundException;

class Injection implements InjectionInterface {
	/**
	 * @var DependencyInterface
	 */
	protected $manager;

	/**
	 * Injects the Dependency Manager
	 * @param DependencyInterface $dependency
	 * @return mixed
	 */
	public final function setManager(DependencyInterface $dependency) {
		$this->manager = $dependency;
	}

	/**
	 * Gets the constructor params
	 * @param \ReflectionClass $reflectionClass
	 * @return array
	 */
	protected function getConstructorParams( \ReflectionClass $reflectionClass ) {
		$params = array();
		$constructor = $reflectionClass->getConstructor();

		if( !$constructor )
			return $params;

		foreach( $constructor->getParameters() as $param ) {
			$params[ $param->getName() ] = $param->isDefaultValueAvailable() ? $param->getDefaultValue() : null;
		}

		return $params;
	}

	/**
	 * Merge the custom parameters with the default
	 * and to the instances already existent
	 * @param $class
	 * @param array $params
	 * @return array|mixed
	 * @throws ClassNotFoundException
	 */
	public function mergeParams( $class, array $params ) {
		$real = array();
		$class = $this->getReflectionClass($class);
		$default = $this->getConstructorParams($class);

		foreach( $default as $name => $defaultValue ) {
			$real[$name] = isset( $params[$name] ) ? $params[$name] : $defaultValue;
		}

		return $real;
	}

	/**
	 * @param $class
	 * @return \ReflectionClass
	 * @throws ClassNotFoundException
	 */
	public function getReflectionClass( $class ) {
		if( !class_exists($class) )
			throw new ClassNotFoundException('Class not found: ' . $class);

		return new \ReflectionClass($class);
	}
}