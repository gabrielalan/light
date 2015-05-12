<?php

namespace Light\Server;

abstract class Response implements ResponseInterface {

	protected function capture() {
		return \HttpResponse::capture();
	}

	public function getBufferSize() {
		return \HttpResponse::getBufferSize();
	}

	public function getCache() {
		return \HttpResponse::getCache();
	}

	public function getCacheControl() {
		return \HttpResponse::getCacheControl();
	}

	public function getContentDisposition() {
		return \HttpResponse::getContentDisposition();
	}

	public function getContentType() {
		return \HttpResponse::getContentType();
	}

	public function getData() {
		return \HttpResponse::getData();
	}

	public function getETag() {
		return \HttpResponse::getETag();
	}

	public function getFile() {
		return \HttpResponse::getFile();
	}

	public function getGzip() {
		return \HttpResponse::getGzip();
	}

	public function getHeader() {
		return \HttpResponse::getHeader();
	}

	public function getLastModified() {
		return \HttpResponse::getLastModified();
	}

	public function getRequestBody() {
		return \HttpResponse::getRequestBody();
	}

	public function getRequestBodyStream() {
		return \HttpResponse::getRequestBodyStream();
	}

	public function getRequestHeaders() {
		return \HttpResponse::getRequestHeaders();
	}

	public function getStream() {
		return \HttpResponse::getStream();
	}

	public function getThrottleDelay() {
		return \HttpResponse::getThrottleDelay();
	}

	public function guessContentType() {

	}

	public function redirect( $url, array $params = array(), $session = false, $status = 301 ) {
		return \HttpResponse::redirect($url, $params, $session, $status);
	}

	protected  function send( $bol = null ) {
		return \HttpResponse::send($bol);
	}

	public function setBufferSize() {

	}

	public function setCache( $bol ) {
		return \HttpResponse::setCache($bol === true);
	}

	public function setCacheControl() {

	}

	public function setContentDisposition() {

	}

	public function setContentType() {

	}

	public function setData() {

	}

	public function setETag() {

	}

	public function setFile() {

	}

	public function setGzip() {

	}

	public function setHeader() {

	}

	public function setLastModified() {

	}

	public function setStream() {

	}

	public function setThrottleDelay() {

	}

	public function setStatus() {

	}
} 