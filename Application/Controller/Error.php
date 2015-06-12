<?php
namespace Application\Controller;

use Light\Controller\Html;

class Error extends Html {

	/**
	 * @var \Exception
	 */
	protected $exception;

	public function index() {
		$view = $this->getView();
		$view->setTemplate('error.html');

		$this->exception = $this->getManager()->get('CurrentError');

		$view->errorName = get_class($this->exception) . ' ' . $this->exception->getCode();
		$view->errorMessage = $this->exception->getMessage();
		$view->errorTrace = $this->exception->getTraceAsString();
	}
} 