<?php

require('../lib/Pushover.php');

$po = new Pushover(/* YOUR API KEY */, /* YOUR USER KEY */);

$po->send( 'Hello World' ) or die('Message Failed');
$po->send( 'Goodbye World', array('priority' => 1)) or die('Message Failed');
$po->send( 'New Comment!', array('url' => 'http://donatstudios.com')) or die('Message Failed');

echo 'All Messages Sent Successfully!' . PHP_EOL;