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