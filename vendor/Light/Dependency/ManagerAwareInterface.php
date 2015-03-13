<?php
namespace Light\Dependency;

interface ManagerAwareInterface {

	/**
	 * Setter
	 * @param Manager $manager
	 * @return mixed
	 */
	public function setManager( Manager $manager );
} 