<?php
namespace Light\Dependency;

use Light\Dependency\AwareContainer\Container;
use Light\Dependency\AwareContainer\ContainerInterface;
use Light\Dependency\Injection\Injection;
use Light\Dependency\Injection\InjectionInterface;

abstract class Dependency implements DependencyInterface {
	/**
	 * @var InjectionInterface
	 */
	private $injection;

	/**
	 * @var ContainerInterface
	 */
	private $awareContainer;

	/**
	 * Aware container for aware interfaces instances
	 * @param ContainerInterface $container
	 * @return mixed
	 */
	public function setAwareContainer(ContainerInterface $container) {
		$container->setManager($this);
		$this->awareContainer = $container;
	}

	/**
	 * @return ContainerInterface
	 */
	public function getAwareContainer() {
		if( !$this->awareContainer )
			$this->setAwareContainer( new Container() );

		return $this->awareContainer;
	}

	/**
	 * @return InjectionInterface
	 */
	public function getInjection() {
		if( !$this->injection )
			$this->setInjection( new Injection() );

		return $this->injection;
	}

	/**
	 * Sets the Injection manager
	 * @param InjectionInterface $injectionInterface
	 * @return mixed
	 */
	public final function setInjection(InjectionInterface $injectionInterface) {
		$this->injection = $injectionInterface;
	}
}