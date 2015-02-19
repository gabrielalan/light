<?php
namespace Light\Dependency;

use Light\Dependency\Injection\Injection;
use Light\Dependency\Injection\InjectionInterface;

abstract class Dependency implements DependencyInterface {
	/**
	 * @var InjectionInterface
	 */
	private $injection;

	/**
	 * @return InjectionInterface
	 */
	public function getInjection() {
		if( !$this->injection )
			$this->injection = new Injection();

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