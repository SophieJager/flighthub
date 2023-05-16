DOCKER_COMPOSE = docker-compose -f docker-compose.yml

install: ## First Install of the project : build container, install component, build database and run fixtures
	$(DOCKER_COMPOSE) pull
	$(DOCKER_COMPOSE) build --no-cache
	$(DOCKER_COMPOSE) run --rm php bash -ci 'composer install'
	$(MAKE) yarn-install
	$(MAKE) assets-install
	$(DOCKER_COMPOSE) run --rm php bash -ci 'php bin/console doctrine:migration:migrate --no-interaction'
	$(DOCKER_COMPOSE) run --rm php bash -ci 'php bin/console doctrine:fixtures:load -n'

connect: ## Connect on a remote bash terminal on the php container
	$(DOCKER_COMPOSE) exec php bash

start: ## Start all container
	$(DOCKER_COMPOSE) up -d

stop: ## Stop all container
	$(DOCKER_COMPOSE) down

status: ## Check container status
	$(DOCKER_COMPOSE) ps

yarn-connect: ## Connect on a remove bash terminal on the yarn container
	$(DOCKER_COMPOSE) run yarn bash

yarn-install: ## Install yarn dependencies
	$(DOCKER_COMPOSE) run --rm yarn bash -ci 'yarn install'

build-assets: ## Build assets (minimized) for production
	$(DOCKER_COMPOSE) run --rm yarn bash -ci 'yarn encore production'

build-assets-watch: ## Build assets for dev in watch mode
	$(DOCKER_COMPOSE) run --rm yarn bash -ci 'yarn encore dev --watch'

assets-install: ## Install composer vendor and setup assets
	$(DOCKER_COMPOSE) run --rm php bash -ci 'php bin/console assets:install'
