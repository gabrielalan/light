<?php
namespace Light\System\Configuration\Part;

class Views extends Part {

	public function execute() {
		$file = $this->getConfiguration()->getFile();

		if( !$file->views || !isset($file->views->paths) )
			return false;

		$paths = array();

		foreach( $file->views->paths as $path ) {
			if( realpath($path) && !in_array($path, $paths) ) {
				$paths[] = $path;
				set_include_path(get_include_path() . PATH_SEPARATOR . realpath($path));
			}
		}
	}
} 