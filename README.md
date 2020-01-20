# rating-task
> ### update, rate products task

----------

# Getting started

## Installation

Clone the repository

    git clone git@github.com:mabdulazim/rating-task.git

Switch to the repo folder

    cd rating-task

Install all the dependencies using composer

    composer install

Start the local development server

    phalcon serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@github.com:mabdulazim/rating-task.git
    cd rating-task
    composer install
    phalcon serve

----------

# Testing API

Run the laravel development server

    phalcon serve

The api can now be accessed at

Request headers for all apis

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| UserId 	          | 1                 |


**GET PRODUCTS LIST**

 GET - http://localhost:8000/api/v1/products/

Request query params

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| No      	| code     	        | 123123 	          |
| No      	| page 	            | 1                 |
| No      	| limit 	          | 10                |



**GET PRODUCT BY ID**

GET - http://localhost:8000/api/v1/products/1/



**UPDATE USER PRODUCT**

PUT - http://localhost:8000/api/v1/products/1

Request body params

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| No      	| code     	        | 123123 	          |
| No      	| name 	            | "test name"       |
| No      	| description 	    | "test desc"       |
| No      	| price       	    | 120               |



**RATE PRODUCT**

 POST - http://localhost:8000/api/v1/rates/1

Request body params

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes       | rate        	    | 120               |


----------

## Folders

- `app/config/router.php` - Contains api routes defined in router.php file
- `app/controllers` - Contains http controllers
- `app//dtos` - Contains data transfer objects layers
- `app/services` - Contains business logic layers
- `app/transformers` - Contains transformers layers
- `app/repositories` - Contains db queries
- `app/models` - Contains models
- `app/exceptions` - Contains error handling



## Dependencies

- [league/fractal](https://github.com/thephpleague/fractal) - provides a presentation and transformation layer for complex data output
