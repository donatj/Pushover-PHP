# Pushover PHP

Pushover PHP is a very light, simple API wrapper for the Pushover API written for PHP.


## Installing

Install the latest version with:

```bash
composer require 'donatj/pushover'
```

## Usage

```php
<?php

require __DIR__ . '/../vendor/autoload.php';

use donatj\Pushover\Options;
use donatj\Pushover\Priority;
use donatj\Pushover\Pushover;
use donatj\Pushover\Sounds;

$po = new Pushover('{myapikey}', '{myuserkey}');

// Simplest example
$po->send('Hello World') or die('Message Failed');

// With Options:
$po->send('Awesome website, great job!', [
	Options::TITLE    => 'New Comment!',
	Options::URL      => 'https://donatstudios.com/CsvToMarkdownTable',
	Options::PRIORITY => Priority::HIGH,
	Options::SOUND    => Sounds::ALIEN,
]) or die('Message Failed');

echo 'All Messages Sent Successfully!' . PHP_EOL;
```

## Documentation

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


### Class: \donatj\Pushover\Options

```php
<?php
namespace donatj\Pushover;

class Options {
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
	 * The optional devices name for the message to be pushed to.
	 * 
	 * If unspecified, your message will be pushed to all devices.
	 */
	const DEVICE = 'device';
	/** The optional message title */
	const TITLE = 'title';
	/** The optional message url */
	const URL = 'url';
	/** The optional message url title. Must specify a URL as well. */
	const URL_TITLE = 'url_title';
	/** The priority of the message being sent. */
	const PRIORITY = 'priority';
	/** An optional UNIX timestamp for your message. Otherwise the current time is used. */
	const TIMESTAMP = 'timestamp';
	/** The sound to play on receiving the pushover message. */
	const SOUND = 'sound';
}
```

### Class: \donatj\Pushover\Priority

```php
<?php
namespace donatj\Pushover;

class Priority {
	const LOWEST = -2;
	const LOW = -1;
	const NORMAL = 0;
	const HIGH = 1;
	const EMERGENCY = 2;
}
```

### Class: \donatj\Pushover\Pushover

Damn Simple API Interface for Pushover Messages

```php
<?php
namespace donatj\Pushover;

class Pushover {
	const API_URL = "https://api.pushover.net/1/messages.json";
}
```

#### Method: Pushover->__construct

```php
function __construct($token, $user [, $apiUrl = self::API_URL])
```

Create a pushover object

##### Parameters:

- ***string*** `$token` - The application API token
- ***string*** `$user` - Your user key
- ***string*** `$apiUrl` - Optionally change the API URL

---

#### Method: Pushover->send

```php
function send($message [, $options = array()])
```

Send the pushover message

##### Parameters:

- ***string*** `$message` - The message to send
- ***array*** `$options` - Optional configuration settings

##### Returns:

- ***bool*** | ***array*** - Returns false on failure, or a data array on success

### Class: \donatj\Pushover\Sounds

```php
<?php
namespace donatj\Pushover;

class Sounds {
	/** Pushover (default) */
	const PUSHOVER = 'pushover';
	/** Bike */
	const BIKE = 'bike';
	/** Bugle */
	const BUGLE = 'bugle';
	/** Cash Register */
	const CASH_REGISTER = 'cashregister';
	/** Classical */
	const CLASSICAL = 'classical';
	/** Cosmic */
	const COSMIC = 'cosmic';
	/** Falling */
	const FALLING = 'falling';
	/** Gamelan */
	const GAMELAN = 'gamelan';
	/** Incoming */
	const INCOMING = 'incoming';
	/** Intermission */
	const INTERMISSION = 'intermission';
	/** Magic */
	const MAGIC = 'magic';
	/** Mechanical */
	const MECHANICAL = 'mechanical';
	/** Piano Bar */
	const PIANO_BAR = 'pianobar';
	/** Siren */
	const SIREN = 'siren';
	/** Space Alarm */
	const SPACE_ALARM = 'spacealarm';
	/** Tug Boat */
	const TUGBOAT = 'tugboat';
	/** Alien Alarm (long) */
	const ALIEN = 'alien';
	/** Climb (long) */
	const CLIMB = 'climb';
	/** Persistent (long) */
	const PERSISTENT = 'persistent';
	/** Pushover Echo (long) */
	const PUSHOVER_ECHO = 'echo';
	/** Up Down (long) */
	const UP_DOWN = 'updown';
	/** None (silent) */
	const NONE = 'none';
}
```