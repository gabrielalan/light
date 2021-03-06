<?php

/*set_error_handler(function($errno, $errstr){
	throw new \ErrorException($errstr, $errno);
});*/

chdir(realpath(dirname(__FILE__)."/../"));

require_once "vendor/Light/System/Loader.php";

$loader = new Light\System\Loader();
$loader->addNamespace('Light', realpath(getcwd() . '/vendor/Light'));
$loader->register();

$system = new Light\Light();
$system->setLoader($loader);
$system->run('Application/Config/application.json');
