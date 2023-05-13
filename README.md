## Install

### Requirements

This projects runs through the following services in production.

- PHP 8.0
- Nginx 1.17
- PostgreSql = 15
- Git

But you'll only need to install this tools to reproduce the same environment easily - as it's dockerized:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/overview/)

### Installation

- Clone the project repository
- Go to root project with your terminal and run command :

```bash
make install

# Take a cup of coffee... ;)
```

This command will just clone the project repository, setup a whole dev environment through docker machines (one by entry 
in the `docker-compose.yml` file) and setup database structure with migrations, and fill it with datas through fixtures.

You'll certainly be prompted for some consumer key / secret from git during composer install. Just generate and tape it, it'll not ask again in the future.

## Development

### Starting Project

A single command allows you to run the project:

```sh
make start
```

If you run `make status` after that, you'll see the corresponding list of containers that
are running.

App instance runs on 8080 port, you can access it on `http://localhost:8080`.

### Stopping Project

If you need to stop all project containers, just use:

```sh
make stop
```