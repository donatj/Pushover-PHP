<?php

namespace donatj\Pushover;

interface Keys {

	/**
	 * The Application API token.
	 *
	 * Defaults to the token \donatj\Pushover\Pushover was constructed with.
	 */
	const TOKEN = 'token';
	/**
	 * The User Key.
	 *
	 * Defaults to the user key \donatj\Pushover\Pushover was constructed with.
	 */
	const USER = 'user';
	/**
	 * @access private
	 */
	const MESSAGE = 'message';
	/**
	 * The optional devices name for the message to be pushed to.
	 *
	 * If unspecified, your message will be pushed to all devices.
	 */
	const DEVICE = 'device';
	/**
	 * The optional message title
	 */
	const TITLE = 'title';
	/**
	 * The optional message url
	 */
	const URL = 'url';
	/**
	 * The optional message url title. Must specify a URL as well.
	 */
	const URL_TITLE = 'url_title';
	/**
	 * The priority of the message being sent.
	 *
	 * @see \donatj\Pushover\Priority for Available options
	 */
	const PRIORITY = 'priority';
	/**
	 * An optional UNIX timestamp for your message. Otherwise the current time is used.
	 */
	const TIMESTAMP = 'timestamp';
	/**
	 * The sound to play on receiving the pushover message.
	 *
	 * @see \donatj\Pushover\Sounds for Available options
	 */
	const SOUND = 'sound';
}
