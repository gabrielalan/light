<?php

namespace Light\System\Configuration;

use Light\System\Configuration\Part\PartInterface;

class PartCollection extends \ArrayObject {

	public function append( PartInterface $value ) {
		parent::append($value);
	}
} 