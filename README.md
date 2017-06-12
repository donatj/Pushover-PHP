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

use donatj\Pushover\Keys;
use donatj\Pushover\Pushover;

$po = new Pushover('{myapikey}', '{myuserkey}');

$po->send('Hello World') or die('Message Failed');
$po->send('Goodbye World', [ Keys::PRIORITY => 1 ]) or die('Message Failed');
$po->send('New Comment!', [ Keys::URL => 'http://donatstudios.com' ]) or die('Message Failed');

echo 'All Messages Sent Successfully!' . PHP_EOL;
```

## Documentation

On *success* `Pushover->send` returns a **truth-y** array like:

```php
array(
    'status'  => 1
    'request' => 2f4e9c7140df52d7d8b16ffb8adf1c2a
)
```

On *failure* `Pushover->send` returns **false** which allows simple

```php
if( !$po->send('Hello World!') ) {
	die('oh no!');
}
```


### Class: \donatj\Pushover\Keys

```php
<?php
namespace donatj\Pushover;

class Keys {
	const TOKEN = 'token';
	const USER = 'user';
	const MESSAGE = 'message';
	const DEVICE = 'device';
	const TITLE = 'title';
	const URL = 'url';
	const URL_TITLE = 'url_title';
	const PRIORITY = 'priority';
	const TIMESTAMP = 'timestamp';
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