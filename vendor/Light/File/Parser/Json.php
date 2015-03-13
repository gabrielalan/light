<?php
namespace Light\File\Parser;

/**
 * JSON Parser
 * @package Light\File\Parser
 */
class Json extends Parser {
	/**
	 * Parse JSON
	 * @return $this|mixed
	 */
	public function parse() {
		if( $this->isParsed() )
			return $this;

		$content = file_get_contents($this->getPath());
		$json = json_decode($content);

		if( $json instanceof \stdClass )
			$this->setParsed($json);
		else {
			$std = new \stdClass();
			$std->root = $json;
			$this->setParsed($std);
		}

		return $this;
	}
}