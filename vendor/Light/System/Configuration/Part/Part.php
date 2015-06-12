<?php

namespace Light\System\Configuration\Part;

use Light\System\Configuration\ConfigurationInterface;

abstract class Part implements PartInterface {

	/**
	 * @var ConfigurationInterface
	 */
	protected $configuration;

	/**
	 * Setter
	 * @param ConfigurationInterface $configuration
	 * @return mixed
	 */
	public function setConfiguration(ConfigurationInterface $configuration) {
		$this->configuration = $configuration;
	}

	/**
	 * @return ConfigurationInterface
	 */
	public function getConfiguration() {
		return $this->configuration;
	}
} 