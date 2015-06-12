<?php
namespace Application\Controller;

use Light\Controller\Html;

class Teste extends Html {

	public function acao() {
		$this->getView()->setTemplate('teste.html');
	}
} 