# Pushover PHP

[![Latest Stable Version](https://poser.pugx.org/donatj/pushover/version)](https://packagist.org/packages/donatj/pushover)
[![Total Downloads](https://poser.pugx.org/donatj/pushover/downloads)](https://packagist.org/packages/donatj/pushover)
[![License](https://poser.pugx.org/donatj/pushover/license)](https://packagist.org/packages/donatj/pushover)
[![ci.yml](https://github.com/donatj/Pushover-PHP/actions/workflows/ci.yml/badge.svg)](https://github.com/donatj/Pushover-PHP/actions/workflows/ci.yml)


Pushover PHP is a very light, simple API wrapper for the Pushover API written for PHP.


## Requirements

- **php**: >=7.3
- **ext-json**: *

## Installing

Install the latest version with:

```bash
composer require 'donatj/pushover'
```

## Usage

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use donatj\Pushover\Exceptions\ResponseException;
use donatj\Pushover\Options;
use donatj\Pushover\Priority;
use donatj\Pushover\Pushover;
use donatj\Pushover\Sounds;

$po = new Pushover('{my_apikey}', '{my_userkey}');

try {
	// Simplest example
	$po->send('Hello World');

	// With Options:
	$po->send('Awesome website, great job!', [
		Options::TITLE    => 'New Comment!',
		Options::URL      => 'https://donatstudios.com/CsvToMarkdownTable',
		Options::PRIORITY => Priority::HIGH,
		Options::SOUND    => Sounds::ALIEN,
	]);
}catch( ResponseException $e ) {
	// Handle exception
}

```

## Documentation

For documentation about the protocol specifics, see the official [Pushover API Documentation](https://pushover.net/api).

On *success* `Pushover->send` returns a **truth-y** array like:

```php
[
    'status'  => '1',
    'request' => '2f4e9c7140df52d7d8b16ffb8adf1c2a',
]
```

On *failure* `Pushover->send` returns **false** which allows simple

```php
if( !$po->send('Hello World!') ) {
	die('oh no!');
}
```


### Class: \donatj\Pushover\Exceptions\ResponseException

```php
<?php
namespace donatj\Pushover\Exceptions;

class ResponseException {
	public const ERROR_CONNECTION_FAILED = 100;
	public const ERROR_DECODE_FAILED = 200;
	public const ERROR_UNEXPECTED = 300;
	public const ERROR_API = 400;
}
```

### Class: \donatj\Pushover\Options

Contains available option keys for the Pushover API

```php
<?php
namespace donatj\Pushover;

class Options {
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
	/** The priority of the message being sent. */
	public const PRIORITY = 'priority';
	/** An optional UNIX timestamp for your message. Otherwise the current time is used. */
	public const TIMESTAMP = 'timestamp';
	/** The sound to play on receiving the pushover message. */
	public const SOUND = 'sound';
	/** A number of seconds that the message will live, before being deleted automatically */
	public const TTL = 'ttl';
}
```

### Class: \donatj\Pushover\Priority

Contains all legal values for 'priority'

```php
<?php
namespace donatj\Pushover;

class Priority {
	public const LOWEST = -2;
	public const LOW = -1;
	public const NORMAL = 0;
	public const HIGH = 1;
	public const EMERGENCY = 2;
}
```

### Class: \donatj\Pushover\Pushover

Dead Simple API Interface for Pushover Messages

```php
<?php
namespace donatj\Pushover;

class Pushover {
	public const API_URL = 'https://api.pushover.net/1/messages.json';
}
```

#### Method: Pushover->__construct

```php
function __construct(string $token, string $user [, string $apiUrl = self::API_URL])
```

Create a pushover object

##### Parameters:

- ***string*** `$token` - The application API token
- ***string*** `$user` - Your user key
- ***string*** `$apiUrl` - Optionally change the API URL

---

#### Method: Pushover->send

```php
function send(string $message [, array $options = []]) : array
```

Send the pushover message

##### Parameters:

- ***string*** `$message` - The message to send
- ***array<string,mixed>*** `$options` - Optional configuration settings

**Throws**: `\donatj\Pushover\Exceptions\ResponseException` - On failure to connect or decode the response

##### Returns:

- ***array*** - The decoded JSON response as an associative array

### Class: \donatj\Pushover\Sounds

Contains legal values for 'sound'

```php
<?php
namespace donatj\Pushover;

class Sounds {
	/** Pushover (default) */
	public const PUSHOVER = 'pushover';
	/** Bike */
	public const BIKE = 'bike';
	/** Bugle */
	public const BUGLE = 'bugle';
	/** Cash Register */
	public const CASH_REGISTER = 'cashregister';
	/** Classical */
	public const CLASSICAL = 'classical';
	/** Cosmic */
	public const COSMIC = 'cosmic';
	/** Falling */
	public const FALLING = 'falling';
	/** Gamelan */
	public const GAMELAN = 'gamelan';
	/** Incoming */
	public const INCOMING = 'incoming';
	/** Intermission */
	public const INTERMISSION = 'intermission';
	/** Magic */
	public const MAGIC = 'magic';
	/** Mechanical */
	public const MECHANICAL = 'mechanical';
	/** Piano Bar */
	public const PIANO_BAR = 'pianobar';
	/** Siren */
	public const SIREN = 'siren';
	/** Space Alarm */
	public const SPACE_ALARM = 'spacealarm';
	/** Tug Boat */
	public const TUGBOAT = 'tugboat';
	/** Alien Alarm (long) */
	public const ALIEN = 'alien';
	/** Climb (long) */
	public const CLIMB = 'climb';
	/** Persistent (long) */
	public const PERSISTENT = 'persistent';
	/** Pushover Echo (long) */
	public const PUSHOVER_ECHO = 'echo';
	/** Up Down (long) */
	public const UP_DOWN = 'updown';
	/** Vibrate Only */
	public const VIBRATE = 'vibrate';
	/** None (silent) */
	public const NONE = 'none';
}
```