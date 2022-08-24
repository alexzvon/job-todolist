## job-todolist

### Инструкция

* ## Загрузка проекта

>\>git clone git@github.com:alexzvon/job-todolist.git

>\>cd job-todolist
* ## Сборка проекта

>\>make build
* ## Запуск проекта

>\>make up
* ## Зайти в котейнер

>\>make laravel
* ## Установить laravel

>\>composer install
* ## Установить npm

>\>npm install
* ## Настроить laravel

>\>cat .env.example \> .env

* ## Миграция

>\>php artisan migrate
* ## Собрать проект

>\>npm run build
* ## Выход из контейнера

>\>exit
* ## Перегрузить проект

>\>make down
>\>make up

* ## Добавить путь к сайту

Добавить строку в /etc/hosts  

10.10.54.10     todolist.loc


Набрать в браузере: http://todolist.loc

* ## Остановить проекта

>\>make down
