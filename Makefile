DOCKER_COMPOSE = docker-compose -f docker-compose.yml

connect: ## Connect on a remote bash terminal on the php container
	$(DOCKER_COMPOSE) exec php bash

start: ## Connect on a remote bash terminal on the php container
	$(DOCKER_COMPOSE) up -d

stop: ## Connect on a remote bash terminal on the php container
	$(DOCKER_COMPOSE) down

status: ## Check container status
	$(DOCKER_COMPOSE) ps