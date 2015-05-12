<?php

namespace Light\Server;

class HttpResponse extends Response {

	public function __construct() {
		$this->setCache(true);
		$this->capture();
	}
} 