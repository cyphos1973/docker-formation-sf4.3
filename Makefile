DOCKER_COMPOSE		= docker-compose
SYMFONY				= $(DOCKER_COMPOSE) exec -T php /usr/bin/entrypoint make --directory=app/
CONTAINER_NAME      = docker-formation

build:
	$(DOCKER_COMPOSE) build

pull:
	$(DOCKER_COMPOSE) pull

start:
	$(DOCKER_COMPOSE) up -d

stop:
	$(DOCKER_COMPOSE) stop

exec:
	docker exec -it ${CONTAINER_NAME}_php bash

down:
	${DOCKER-COMPOSE} down

compose-install:
	docker run -it ${CONTAINER_NAME}_php compose install
