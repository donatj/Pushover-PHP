<?php

use Corpus\PhpCsFixer\Config;
use PhpCsFixer\Finder;

$config = Config::php7x4();

if( method_exists($config, 'setUnsupportedPhpVersionAllowed') ) {
	$config->setUnsupportedPhpVersionAllowed(true);
}

return $config
	->setFinder(
		Finder::create()
			->files()
			->in(__DIR__ . '/src')
			->in(__DIR__ . '/test')
			->name('*.php'),
	);
