<?php

use Corpus\PhpCsFixer\Config;
use PhpCsFixer\Finder;

return Config::php7x4()
	->setUnsupportedPhpVersionAllowed(true)
	->setFinder(
		Finder::create()
			->files()
			->in(__DIR__ . '/src')
			->in(__DIR__ . '/test')
			->name('*.php'),
	);
