.DEFAULT_GLOBAL = help
SHELL:=/bin/bash

.PHONY: assets vendors test-init

ENV = dev

RUNNER=docker-compose exec -eAPP_ENV=$(ENV)
CONSOLE=$(RUNNER) php bin/console
#
#RUNNER=symfony
#CONSOLE=$(RUNNER) console

serve: ## Starts symfony local server
	@symfony server:stop
	symfony serve -d --no-tls

start:
	docker-compose up -d --build

syl-install:
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
	XDEBUG_MODE=coverage vendor/bin/phpspec run

behat:
	@rm -rf etc/build/*
	vendor/bin/behat

ecs:
	$(RUNNER) php vendor/bin/ecs check src --fix
	$(RUNNER) php vendor/bin/ecs check spec --fix
