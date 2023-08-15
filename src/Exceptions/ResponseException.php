<?php

namespace donatj\Pushover\Exceptions;

class ResponseException extends \RuntimeException {

	public const ERROR_CONNECTION_FAILED = 100;
	public const ERROR_DECODE_FAILED     = 200;
	public const ERROR_UNEXPECTED        = 300;

}
