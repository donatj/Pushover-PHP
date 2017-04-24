<?php

namespace donatj\Pushover;

/**
 * Damn Simple API Interface for Pushover Messages
 *
 * @author Jesse G. Donat <donatj@gmail.com>
 * @license MIT
 */
class Pushover {

	const API_URL = "https://api.pushover.net/1/messages.json";

	/**
	 * @var string
	 */
	private $token;

	/**
	 * @var string
	 */
	private $user;

	/**
	 * @var string
	 */
	private $apiUrl;

	/**
	 * Create a pushover object
	 *
	 * @param string $token The application API token
	 * @param string $user Your user key
	 * @param string $apiUrl Optionally change the API URL
	 */
	public function __construct( $token, $user, $apiUrl = self::API_URL ) {
		$this->token  = $token;
		$this->user   = $user;
		$this->apiUrl = $apiUrl;
	}

	/**
	 * Send the pushover message
	 *
	 * @see    https://pushover.net/api
	 *
	 * @param  string $message The message to send
	 * @param  array  $options Optional configuration settings
	 * @return bool|array       Returns false on failure, or a data array on success
	 */
	public function send( $message, array $options = array() ) {
		$options['token']   = $this->token;
		$options['user']    = $this->user;
		$options['message'] = $message;

		$opts = array( 'http' => array(
			'method'  => 'POST',
			'header'  => 'Content-type: application/x-www-form-urlencoded',
			'content' => http_build_query($options),
		) );

		$context = stream_context_create($opts);

		if( $result = @file_get_contents($this->apiUrl, false, $context) ) {
			if( $final = json_decode($result, true) ) {
				return $final;
			}
		}

		return false;
	}

}
