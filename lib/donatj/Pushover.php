<?php

namespace donatj;

/**
 * Damn Simple API Interface for Pushover Messages
 *
 * @author Jesse G. Donat <donatj@gmail.com>
 * @license MIT
 */
class Pushover {

	const API_URL = "https://api.pushover.net/1/messages.json";

	private $token;
	private $user;

	/**
	 * Create a pushover object
	 *
	 * @param string $token     The application API token
	 * @param string $user      Your user key
	 */
	public function __construct( $token, $user ) {
		$this->token = $token;
		$this->user  = $user;
	}

	/**
	 * Send the pushover message
	 * 
	 * @see    https://pushover.net/api
	 * 
	 * @param  string $message  The message to send
	 * @param  array  $options  Optional configuration settings
	 * @return bool|array      Returns false on failure, or a data array on success
	 */
	public function send( $message, array $data = array() ) {

		$data['token']   = $this->token;
		$data['user']    = $this->user;
		$data['message'] = $message;

		$opts = array( 'http' =>
		   array(
			   'method'  => 'POST',
			   'header'  => 'Content-type: application/x-www-form-urlencoded',
			   'content' => http_build_query($data),
		   )
		);

		$context = stream_context_create($opts);

		if( $result = @file_get_contents(self::API_URL, false, $context) ) {
			if( $final = json_decode($result, true) ) {
				return $final;
			}
		}

		return false;

	}

}