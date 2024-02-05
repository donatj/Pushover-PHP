SRC_FILES = $(shell find example src -type f -name '*.php')

.PHONY: test
test: lint
	vendor/bin/phpunit

.PHONY: lint
lint: cs fixer-dry-run phpstan

.PHONY: cs
cs:
	vendor/bin/phpcs

.PHONY: cbf
cbf:
	vendor/bin/phpcbf

.PHONY: phpstan
phpstan:
	vendor/bin/phpstan analyse

.PHONY: fix
fix: cbf fixer

.PHONY: fixer
fixer:
	vendor/bin/php-cs-fixer fix

.PHONY: fixer-dry-run
fixer-dry-run:
	vendor/bin/php-cs-fixer fix --dry-run
