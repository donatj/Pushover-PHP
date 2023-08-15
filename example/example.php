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
