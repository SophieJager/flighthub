DOCKER_COMPOSE = docker-compose -f docker-compose.yml

install: ## First Install of the project : build container, install component, build database and run fixtures
	$(DOCKER_COMPOSE) pull
	$(DOCKER_COMPOSE) build
	$(DOCKER_COMPOSE) run --rm php bash -ci 'composer install'
	$(DOCKER_COMPOSE) run --rm php bash -ci 'php bin/console doctrine:migration:migrate --no-interaction'
	#$(DOCKER_COMPOSE) run --rm php bash -ci 'php bin/console doctrine:fixtures:load -n'

connect: ## Connect on a remote bash terminal on the php container
	$(DOCKER_COMPOSE) exec php bash

start: ## Start all container
	$(DOCKER_COMPOSE) up -d

stop: ## Stop all container
	$(DOCKER_COMPOSE) down

status: ## Check container status
	$(DOCKER_COMPOSE) ps