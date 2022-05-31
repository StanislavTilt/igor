## Документация
Документация находиться в корне проекта

Документация настроена , нужно только поменять на домен который настроен на локал сервере в variables

Postman collection : igor test.postman_collection.json

Test mail : test@mail.com

Так же доку можно глянуть по ссылке

https://documenter.getpostman.com/view/10522838/Uz5DpxEs

# Развертывание

Выполнить комманды
>composer install 

Создать файл .env с данными от локал сервера

Выполнить комманды  
>php artisan config:cache


>php artisan migrate:fresh --seed

