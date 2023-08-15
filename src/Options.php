<?php

namespace donatj\Pushover;

/**
 * Contains available option keys for the Pushover API
 *
 * @see https://pushover.net/api
 */
interface Options {

	/**
	 * The Application API token.
	 *
	 * Defaults to the token \donatj\Pushover\Pushover was constructed with.
	 */
	public const TOKEN = 'token';
	/**
	 * The User Key.
	 *
	 * Defaults to the user key \donatj\Pushover\Pushover was constructed with.
	 */
	public const USER = 'user';
	/** @access private */
	public const MESSAGE = 'message';
	/** To enable HTML formatting, include HTML parameter set to 1. May not be used if monospace is used. */
	public const HTML = 'html';
	/** To enable Monospace formatting, include HTML parameter set to 1. May not be used if html is used. */
	public const MONOSPACE = 'monospace';
	/**
	 * The optional devices name for the message to be pushed to.
	 *
	 * If unspecified, your message will be pushed to all devices.
	 */
	public const DEVICE = 'device';
	/** The optional message title */
	public const TITLE = 'title';
	/** The optional message url */
	public const URL = 'url';
	/** The optional message url title. Must specify a URL as well. */
	public const URL_TITLE = 'url_title';
	/**
	 * The priority of the message being sent.
	 *
	 * @see \donatj\Pushover\Priority for Available options
	 */
	public const PRIORITY = 'priority';
	/** An optional UNIX timestamp for your message. Otherwise the current time is used. */
	public const TIMESTAMP = 'timestamp';
	/**
	 * The sound to play on receiving the pushover message.
	 *
	 * @see \donatj\Pushover\Sounds for Available options
	 */
	public const SOUND = 'sound';

	/** A number of seconds that the message will live, before being deleted automatically */
	public const TTL = 'ttl';

}
