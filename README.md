# LaraAutoPayments

## Управление контейнерами

- Поднять контейнеры: `make up`
- Остановить контейнеры: `make down`
- Зайти в контейнер разработки: `make shell`

## 1 Установка
- для начала нужны инструменты для работы с Makefile
- `cp .env.example .env`
- `make up`
- `make shell`
- `composer install`
- `npm install`
- `art key:generate`
- `migrate`
- `seed`

## 2 Приложение
- приложение доступно по адресу http://localhost на 80 порту
- для подключения xDebug наружу смотрит порт 9003
