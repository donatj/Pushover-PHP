<?php

namespace donatj\Pushover;

use donatj\Pushover\Exceptions\ResponseException;

/**
 * Dead Simple API Interface for Pushover Messages
 *
 * @author Jesse G. Donat <donatj@gmail.com>
 * @license MIT
 */
class Pushover {

	public const API_URL = 'https://api.pushover.net/1/messages.json';

	/** @var string */
	private $token;

	/** @var string */
	private $user;

	/** @var string */
	private $apiUrl;

	/**
	 * Create a pushover object
	 *
	 * @param string $token  The application API token
	 * @param string $user   Your user key
	 * @param string $apiUrl Optionally change the API URL
	 */
	public function __construct( string $token, string $user, string $apiUrl = self::API_URL ) {
		$this->token  = $token;
		$this->user   = $user;
		$this->apiUrl = $apiUrl;
	}

	/**
	 * Send the pushover message
	 *
	 * @see    https://pushover.net/api
	 *
	 * @param string $message The message to send
	 * @param array  $options Optional configuration settings
	 * @throws ResponseException On failure to connect or decode the response
	 * @return array       The decoded JSON response as an associative array
	 */
	public function send( string $message, array $options = [] ) : array {
		$options[Options::TOKEN]   = $this->token;
		$options[Options::USER]    = $this->user;
		$options[Options::MESSAGE] = $message;

		$opts = [ 'http' => [
			'method'  => 'POST',
			'header'  => 'Content-Type: application/x-www-form-urlencoded',
			'content' => http_build_query($options),
		] ];

		$context = stream_context_create($opts);

		$result = @file_get_contents($this->apiUrl, false, $context);
		if( $result === false ) {
			throw new ResponseException(
				'Failed to connect to Pushover API',
				ResponseException::ERROR_CONNECTION_FAILED
			);
		}

		try {
			$final = json_decode($result, true, 512, JSON_THROW_ON_ERROR);
		}catch( \JsonException $ex ) {
			throw new ResponseException(
				'Failed to decode Pushover API response',
				ResponseException::ERROR_DECODE_FAILED,
				$ex
			);
		}

		if( !is_array($final) ) {
			throw new ResponseException(
				'Unexpected response from Pushover API',
				ResponseException::ERROR_UNEXPECTED
			);
		}

		return $final;
	}

}
