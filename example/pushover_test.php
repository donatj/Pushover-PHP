<?php

require __DIR__ . '/../vendor/autoload.php';

use donatj\Pushover\Keys;
use donatj\Pushover\Pushover;

$po = new Pushover('{myapikey}', '{myuserkey}');

$po->send('Hello World') or die('Message Failed');
$po->send('Goodbye World', [ Keys::PRIORITY => 1 ]) or die('Message Failed');
$po->send('New Comment!', [ Keys::URL => 'http://donatstudios.com' ]) or die('Message Failed');

echo 'All Messages Sent Successfully!' . PHP_EOL;