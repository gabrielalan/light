<?php
namespace Light;

use Light\Dependency\DependencyInterface;
use Light\Dependency\Manager;
use Light\File\Parser\Factory;
use Light\System\Configuration\LightConfigurator as Configuration;
use Light\System\Configuration\ConfigurationInterface;
use Light\System\Loader;

class Light {
	/**
	 * @var DependencyInterface
	 */
	private $dependencyManager;

	/**
	 * @param DependencyInterface $dependencyInterface
	 */
	public function setDependencyManager( DependencyInterface $dependencyInterface ) {
		$this->dependencyManager = $dependencyInterface;
	}

	/**
	 * @return DependencyInterface
	 */
	public function getDependencyManager() {
		if( !$this->dependencyManager )
			$this->setDependencyManager( new Manager() );

		return $this->dependencyManager;
	}

	public function setLoader( Loader $loader ) {
		$this->getDependencyManager()->set('Light\System\Loader', $loader);
	}

	/**
	 * Runs the application
	 * @param $configuration
	 * @throws File\Parser\Exceptions\ParserNotFoundException
	 */
	public function run( $configuration ) {
		try {
			$dm = $this->getDependencyManager();

			if ($configuration instanceof ConfigurationInterface) {
				$config = $configuration;
			} else {
				$file = Factory::createByType($configuration);
				$config = new Configuration($file);
			}

			$dm->set('Light\System\Configuration', $config);

			$config->execute();

			$dm->get('Light\Router\Manager')->dispatch();
		} catch( \Exception $exception ) {
			var_dump($exception);
		}
	}
}