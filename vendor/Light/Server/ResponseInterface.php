<?php

namespace Light\Server;

interface ResponseInterface {
	public function getBufferSize();

	public function getCache();

	public function getCacheControl();

	public function getContentDisposition();

	public function getContentType();

	public function getData();

	public function getETag();

	public function getFile();

	public function getGzip();

	public function getHeader();

	public function getLastModified();

	public function getRequestBody();

	public function getRequestBodyStream();

	public function getRequestHeaders();

	public function getStream();

	public function getThrottleDelay();

	public function guessContentType();

	public function redirect( $url, array $params = array(), $session = false, $status = 301 );

	public function setBufferSize();

	public function setCache( $bol );

	public function setCacheControl();

	public function setContentDisposition();

	public function setContentType();

	public function setData();

	public function setETag();

	public function setFile();

	public function setGzip();

	public function setHeader();

	public function setLastModified();

	public function setStream();

	public function setThrottleDelay();

	public function setStatus();
}