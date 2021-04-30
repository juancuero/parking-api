# Proyecto - Juan Cuero | Juan Camacho

## Requirements

- Laravel 8.12
- PHP >= ^7.3 

## Installation

Clone the repository

    git clone https://github.com/juancuero/parking-api.git
  
 Switch to the repo folder

    cd parking-api

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
    
Run the database migrations and default data

    php artisan migrate --seed
    
    User: juan.cuero
    Pass: juancuero123

Run passport

    php artisan passport:install

Run documentation api

    php artisan l5-swagger:generate

This will create some products that you can use:
    
Start the local development server

    php artisan serve
    
Heroku: http://parking-eis.herokuapp.com/    
    
