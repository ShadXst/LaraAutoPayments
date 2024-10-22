# LaraAutoPayments

The auto payments application based on the Laravel Framework.
Auto payment are implemented in the form of Scheduled Command for those, who scared of Queues and Cache.

## Available ReadMe:
- [English](README.md)
- [Russian](README.ru.md)

##  Install
> Please, install Makefile before you proceed to the next steps
- `cp .env.example .env`
- `make up`
- `make shell`
- `composer install`
- `npm install`
- `art key:generate`
- `migrate`
- `seed`

## Docker control

- Run docker containers: `make up`
- Stop all containers: `make down`
- Got to Dev-container shell: `make shell`

##  App and Debugging
- the app is available at http://localhost at the port 80
- to debug your app, xDebug has exposed port 9003
