<?php
namespace Light;

use Light\Dependency\DependencyInterface;
use Light\Dependency\Manager;
use Light\File\Parser\Factory;
use Light\Server\HttpResponse;
use Light\System\Configuration\LightConfigurator as Configuration;
use Light\System\Configuration\ConfigurationInterface;
use Light\System\ErrorManagement;
use Light\System\Loader;

class Light {
	/**
	 * @var DependencyInterface
	 */
	private $dependencyManager;

	/**
	 * @var ConfigurationInterface
	 */
	protected $configuration;

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
	 * @param $configuration
	 * @return Configuration
	 * @throws File\Parser\Exceptions\ParserNotFoundException
	 */
	protected function createConfiguration( $configuration ) {
		$file = Factory::createByType($configuration);
		$config = new Configuration($file);

		return $config;
	}

	protected function setConfiguration( $configuration ) {
		$dm = $this->getDependencyManager();

		if ($configuration instanceof ConfigurationInterface) {
			$config = $configuration;
		} else {
			$config = $this->createConfiguration($configuration);
		}

		$this->configuration = $config;
		$dm->set('Light\System\Configuration', $config);
	}

	/**
	 * Preconfigure the app
	 */
	protected function preConfigure() {
	}

	/**
	 * Runs the application
	 * @param $configuration
	 * @throws File\Parser\Exceptions\ParserNotFoundException
	 */
	public function run( $configuration ) {
		$manager = $this->getDependencyManager();

		try {
			$this->preConfigure();

			$this->setConfiguration( $configuration );

			$this->configuration->execute();

			$manager->get('Light\Router\Manager')->dispatch();
		} catch( \Exception $exception ) {
			$management = new ErrorManagement($exception);

			$manager->getAwareContainer()->inject($management);

			$management->manage();
		}
	}
}