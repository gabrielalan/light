<?php
namespace Light\System\Configuration\Part;

use Light\System\Configuration\ConfigurationInterface;

interface PartInterface {

	public function setConfiguration( ConfigurationInterface $configuration );

	public function execute();
} 