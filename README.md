# todo-app

# Command

docker-compose build
docker-compose up -d
docker-compose ps

docker-compose exec php /bin/bash

    composer install
    php artisan key:generate

    # cache all of your configuration files into a single file
    php artisan config:cache

    # Migration if not already done
    php artisan migrate:fresh --seed

    # Storage
    php artisan storage:link


# Delete all container images and re-build
docker-compose stop 
docker-compose rm
docker-compose build
docker-compose up -d