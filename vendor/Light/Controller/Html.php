<?php
namespace Light\Controller;

use Light\View\Html as HtmlView;

/**
 * Abstract Class Html that represents the HTML Controller, and
 * sets the default view to HtmlView
 * @package Light\Controller
 */
abstract class Html extends Controller {

	/**
	 * The constructor sets the HTML View
	 */
	public function __construct() {
		$this->setView(new HtmlView());
	}
} 