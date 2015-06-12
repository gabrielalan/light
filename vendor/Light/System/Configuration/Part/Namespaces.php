<?php
namespace Light\System\Configuration\Part;

class Namespaces extends Part {

	public function execute() {
		$file = $this->getConfiguration()->getFile();

		if( !$file->namespaces )
			return false;

		foreach( $file->namespaces as $namespace ) {
			if( realpath($namespace->baseDir) )
				$this->getConfiguration()->getManager()->get('Light\System\Loader')->addNamespace( $namespace->namespace, realpath($namespace->baseDir) );
		}
	}
} 