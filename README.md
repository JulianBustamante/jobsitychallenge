# Jobsity Challenge

[![Build Status](https://travis-ci.org/guillaumebriday/laravel-blog.svg?branch=master)](https://travis-ci.org/guillaumebriday/laravel-blog)

## Installation

Development environment requirements :
- [Docker](https://www.docker.com) >= 17.06 CE
- [Docker Compose](https://docs.docker.com/compose/install/)

Enviroment files were committed to make easier testing the challenge.

1. Enter the laradock folder and run the containers.

    ```
    cd laradock
    docker-compose up -d nginx mysql workspace
    ```

2. Open your /etc/hosts file and map your localhost address 127.0.0.1 to the julian_bustamante.jobsitychallenge.com domain, by adding the following:

    ```
    127.0.0.1    julian_bustamante.jobsitychallenge.com
    ```

3. Install Composer and NPM dependencies.

    ```
    docker-compose run workspace composer install
    docker-compose run workspace npm install
    ```

4. Generate symbolic link to Storage

    ```
    docker-compose run workspace php artisan storage:link
    ```

5. Create the database and grant permissions

    ```
    docker-compose exec mysql mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS jobsitychallenge; GRANT ALL ON jobsitychallenge.* TO 'default'@'%'"
    ```

6. Run migrations

    ```
    docker-compose run workspace php artisan migrate
    ```

7. Run seeders to create initial data.

    ```
    docker-compose run workspace php artisan db:seed
    ```
    
8. Compile assets

    ```
    docker-compose run workspace npm run dev
    ```

9. Go to `http://julian_bustamante.jobsitychallenge.com`

