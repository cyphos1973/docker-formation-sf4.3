CONSOLE	= bin/console
COMPOSER = composer

##
###---------------------------#
###    Project commands (SF)  #
###---------------------------#
##

install:			.env.local vendor db-init ## Set up the project : copy the env and start the project with vendors and DB

sf-console\:%:		## Calling Symfony console
					$(CONSOLE) $* $(ARGS)

.PHONY:				install

##
###-------------------------#
###    Doctrine commands    #
###-------------------------#
##

db-destroy: 		## Execute doctrine:database:drop --force command
					$(CONSOLE) doctrine:database:drop --force

db-create:			## Execute doctrine:database:create
					$(CONSOLE) doctrine:database:create

db-migrate:			## Execute doctrine:migrations:migrate
					$(CONSOLE) doctrine:migrations:migrate --allow-no-migration --no-interaction --all-or-nothing

db-fixtures: 		## Execute doctrine:fixtures:load
					$(CONSOLE) doctrine:fixtures:load --no-interaction

db-fixtures-test: 	## Execute doctrine:fixtures:load fo test env
					$(CONSOLE) doctrine:database:create --env=test
					$(CONSOLE) doctrine:migrations:migrate --allow-no-migration --no-interaction --all-or-nothing --env=test
					$(CONSOLE) doctrine:fixtures:load --no-interaction --env=test

db-diff:			## Execute doctrine:migration:diff
					$(CONSOLE) doctrine:migrations:diff --formatted

db-validate:		## Validate the doctrine ORM mapping
					$(CONSOLE) doctrine:schema:validate

db-init: 			vendor db-create db-migrate db-fixtures db-fixtures-test ## Initialize database e.g : wait, create database and migrations

db-update: 			vendor db-diff db-migrate ## Alias coupling db-diff and db-migrate

.PHONY: 			db-destroy db-create db-migrate db-fixtures db-fixtures-test db-diff db-validate db-init db-update

##
###----------------------------#
###    Rules based on files    #
###----------------------------#
##

vendor:				./composer.json ## Install dependencies (vendor) (might be slow)
					@echo 'Might be very slow for the first launch.'
					$(COMPOSER) install --prefer-dist --no-progress

.env.local:			./.env ## Create env.local
					@echo '\033[1;42m/\ The .env.local was just created. Feel free to put your config in it.\033[0m';
					cp ./.env ./.env.local;

##
###------------#
###    Utils   #
###------------#
##

cc:					## Clear cache
					$(CONSOLE) cache:clear

clean:				qa-clean-conf cc ## Remove all generated files
					rm -rvf ./vendor ./var
					rm -rvf ./.env.local

clear:				db-destroy clean ## Remove all generated files and db

update:				## Update dependencies
					$(COMPOSER) update --lock --no-interaction

update-prod:		## Update dependencies for prod
					$(COMPOSER) update --no-dev --optimize-autoloader
					$(CONSOLE) cache:clear --env=prod
					$(COMPOSER) dump-autoload --optimize --no-dev --classmap-authoritative
					# sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx var/cache var/log
                    # sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx var/cache var/log

.PHONY:				cc clean clear update update-prod

##
###-------------------#
###    PhpUnit Tests  #
###-------------------#
##

tu:					vendor ## Run unit tests (might be slow for the first time)
					./bin/phpunit --exclude-group Functional

tf:					vendor ## Run functional tests
					./bin/phpunit --group Functional

tw:					vendor ## Run wip tests
					./bin/phpunit --group wip

coverage:			vendor ## Run code coverage of PHPunit suite
					./bin/phpunit --coverage-html ./var/coverage

tests: 				tu tf tw coverage ## Alias coupling all PHPUnit tests

.PHONY:				tu tf tw coverage tests

##
###----------------#
###    Q&A tools   #
###----------------#
##

lt:					vendor ## Lint twig templates
					$(CONSOLE) lint:twig ./templates

ly:					vendor ## Lint yaml conf files
					$(CONSOLE) lint:yaml ./config

lc:					vendor ## Ensures that arguments injected into services match type declarations
					$(CONSOLE) lint:container

lint:				lt ly lc ## Lint twig and yaml files

security:			vendor ## Check security of your dependencies (https://security.sensiolabs.org/)
					./vendor/bin/security-checker security:check

qa-clean-conf:		## Erasing all quality assurance conf files
					rm -rvf ./.php_cs ./phpcs.xml ./.phpcs-cache ./phpmd.xml ./.phpunit.result.cache

.PHONY:				lt ly lc lint security qa-clean-conf

##
###------------#
###    Help    #
###------------#
##

.DEFAULT_GOAL := 	help

help:				## Display all help messages
					@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-20s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

.PHONY: 			help
