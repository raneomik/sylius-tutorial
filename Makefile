.DEFAULT_GLOBAL = help
SHELL:=/bin/bash

.PHONY: assets

ENV = dev

#RUNNER=docker-compose exec -eAPP_ENV=$(ENV)
#CONSOLE=$(RUNNER) php bin/console

RUNNER=symfony
CONSOLE=$(RUNNER) console

install: start composer assets-init assets syl-init

start: serve up

serve: ## Starts symfony local server
	@symfony server:stop
	symfony serve -d --no-tls

up:
	docker-compose up -d --build --remove-orphans

stop:
	docker-compose stop
	@symfony server:stop

assets-init: yarn.lock
	yarn
	yarn cache clean

assets: yarn.lock
	$(CONSOLE) assets:install --no-interaction
	$(CONSOLE) sylius:theme:assets:install public --no-interaction
	yarn gulp

watch: yarn.lock
	yarn watch

composer:
	$(RUNNER) composer install --prefer-dist --no-progress --no-interaction

syl-init:
	$(CONSOLE) sylius:install

cc:
	$(CONSOLE) ca:cl -e$(ENV)

db-init:
	$(CONSOLE) d:d:d --force -e$(ENV)
	$(CONSOLE) d:d:c -e$(ENV)

db-diff:
	$(CONSOLE) d:mig:diff -e$(ENV)

db-mig:
	$(CONSOLE) d:mig:mig -n -e$(ENV)
db-schema:
	$(CONSOLE) d:s:c -n -e$(ENV)

db-all: db-init db-schema

phpspec:
	XDEBUG_MODE=coverage $(RUNNER) php vendor/bin/phpspec run

behat:
	@rm -rf etc/build/*
	APP_ENV=test $(RUNNER) php vendor/bin/behat

ecs:
	$(RUNNER) php vendor/bin/ecs check src --fix
	$(RUNNER) php vendor/bin/ecs check spec --fix
