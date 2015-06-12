<?php

namespace Light\View;

use Light\View\Exceptions\TemplateNotFoundException;

class Html extends View {

	public function render() {
		$template = $this->getTemplate();

		if( stream_resolve_include_path($template) ) {
			include $template;
		} else {
			throw new TemplateNotFoundException("The resquested template '{$template}' cannot be found");
		}
	}
} 