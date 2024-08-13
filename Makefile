include docker/.env

DC = docker compose -f ./docker/docker-compose-$(TARGET).yml
PHP = $(DC) exec -u www-data php
NGINX = $(DC) exec -it nginx
DB = $(DC) exec -it db
CI = composer install --prefer-dist --no-progress --no-scripts --no-interaction
BIN = bin/console
DDC = $(BIN) d:d:c --if-not-exists
DMM = $(BIN) d:m:m -n
DFL = $(BIN) d:f:load -n
DIF = $(BIN) d:m:diff
CC = $(BIN) c:c

##################
# Docker compose
##################

dc_build:
	@$(DC) build

dc_start:
	@$(DC) start

dc_stop:
	@$(DC) stop

dc_up:
	@$(DC) up -d --remove-orphans

dc_ps:
	@$(DC) ps

dc_logs:
	@$(DC) logs -f

dc_down:
	@$(DC) down --rmi=local --remove-orphans



##################
# App
##################

php_refresh:
	@$(DC) up -d --build --no-deps php
	@$(PHP) $(BIN) c:c

db_refresh:
	@$(PHP) $(BIN) d:d:d -f
	@$(PHP) $(BIN) d:d:c
	@$(PHP) $(BIN) d:m:m -n
	@$(PHP) $(BIN) d:f:load -n

php_bash:
	@$(PHP) bash

nginx_bash:
	@$(NGINX) bash

db_bash:
	@$(DB) bash

php_ci:
	@$(PHP) $(CI)

php_ddc:
	@$(PHP) $(DDC) 

php_cc:
	@$(PHP) $(CC) 

php_dmm:
	@sleep 5
	@$(PHP) $(DMM)

php_dfl:
	@$(PHP) $(DFL)

php_dif:
	@$(PHP) $(DIF)

composer: ## Run composer, pass the parameter "c=" to run a given command, example: make composer c='req symfony/orm-pack'
	@$(eval c ?=)
	@$(PHP) composer $(c)

bc: ## Run bin/console, pass the parameter "c=" to run a given command, example: make bc c='make:entity'
	@$(eval c ?=)
	@$(PHP) $(BIN) $(c)

restart:
	@$(DC) down --rmi=local --remove-orphans
	@$(DC) up -d --build --remove-orphans
	@$(PHP) bin/console cache:clear
	@$(PHP) composer install
	@$(PHP) bash

prod:
	@$(DC) up -d --build --remove-orphans
	@$(PHP) composer install --no-dev --optimize-autoloader
	@$(PHP) bin/console cache:clear