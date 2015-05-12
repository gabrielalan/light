<?php
namespace Light;

use Light\Dependency\DependencyInterface;
use Light\Dependency\Manager;
use Light\File\Parser\Factory;
use Light\Server\HttpResponse;
use Light\System\Configuration\LightConfigurator as Configuration;
use Light\System\Configuration\ConfigurationInterface;
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

	protected function setConfiguration( $configuration ) {
		$dm = $this->getDependencyManager();

		if ($configuration instanceof ConfigurationInterface) {
			$config = $configuration;
		} else {
			$file = Factory::createByType($configuration);
			$config = new Configuration($file);
		}

		$this->configuration = $config;
		$dm->set('Light\System\Configuration', $config);
	}

	/**
	 * Preconfigure the app
	 */
	protected function preConfigure() {
		$dm = $this->getDependencyManager();

		if( $dm->has('Light\Server\Response') )
			return true;

		$response = new HttpResponse();

		$dm->set('Light\Server\Response', $response);
		$dm->getAwareContainer()->add('Light\Server\ResponseAwareInterface', 'Light\Server\Response');
	}

	/**
	 * Runs the application
	 * @param $configuration
	 * @throws File\Parser\Exceptions\ParserNotFoundException
	 */
	public function run( $configuration ) {
		try {
			$this->preConfigure();

			$this->setConfiguration( $configuration );

			$this->configuration->execute();

			$this->getDependencyManager()->get('Light\Router\Manager')->dispatch();
		} catch( \Exception $exception ) {
			var_dump($exception);
		}
	}
}