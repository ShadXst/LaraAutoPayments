#!/usr/bin/make

ifneq ($(if $(MAKECMDGOALS),$(words $(MAKECMDGOALS)),1),1)
.SUFFIXES:
TARGET := $(if $(findstring :,$(firstword $(MAKECMDGOALS))),,$(firstword $(MAKECMDGOALS)))
PARAMS := $(if $(findstring :,$(firstword $(MAKECMDGOALS))),$(MAKECMDGOALS),$(wordlist 2,100000,$(MAKECMDGOALS)))
.DEFAULT_GOAL = help
.PHONY: ONLY_ONCE
ONLY_ONCE:
	$(MAKE) $(TARGET) COMMAND_ARGS="$(PARAMS)"
%: ONLY_ONCE
	@:
else

help: ## Help
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

SHELL = /bin/sh

shell: ## Start shell into app container
	docker compose exec -u laravel workspace bash

build:
	docker compose build

up: ## Create and start containers
	docker compose up -d --remove-orphans

up-build:
	docker compose up -d --build

up-kafka:
	docker compose --profile kafka up -d

init: ## Make full application initialization
	docker compose exec -T app php artisan migrate --force
	docker compose exec -T app php artisan storage:link
	docker compose exec -T app php artisan optimize:clear
	docker compose exec -T app php artisan optimize
	docker compose exec -T app php artisan view:cache
	docker compose exec -T workers php /var/www/html/artisan queue:restart

init-development: install-dev-packages init

install-dev-packages:
	docker compose exec -T app composer install

down: ## Stop containers
	docker compose down

down-kafka:
	docker compose --profile kafka down

restart: down up ## Restart all containers

ps: ## List of all containers in the project
	docker compose ps

ecs: ## Проверка стиля кода
	@./vendor/bin/ecs $(COMMAND_ARGS)

endif
