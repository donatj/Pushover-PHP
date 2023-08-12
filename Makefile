SRC_FILES = $(shell find example src -type f -name '*.php')

.PHONY: test
test: lint
	vendor/bin/phpunit

.PHONY: lint
lint: cs fixer-dry-run

.PHONY: cs
cs:
	vendor/bin/phpcs

.PHONY: cbf
cbf:
	vendor/bin/phpcbf

.PHONY: fix
fix: cbf fixer

.PHONY: fixer
fixer:
	PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix

.PHONY: fixer-dry-run
fixer-dry-run:
	PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix --dry-run
