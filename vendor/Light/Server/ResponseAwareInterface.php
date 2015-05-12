<?php

namespace Light\Server;

/**
 * To classes that wants to get the Response instance
 *
 * Interface ResponseAwareInterface
 * @package Light\Server
 */
interface ResponseAwareInterface {

	/**
	 * Setter of the response
	 *
	 * @param ResponseInterface $response
	 * @return mixed
	 */
	public function setResponse( ResponseInterface $response );
} 