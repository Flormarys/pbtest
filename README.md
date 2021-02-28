# About this repo

I created this repo for practicing and learning about Laravel, PHP and OOP practices.
This is one of the pre screening test from a Canadian company for a Full Stack PHP Developer.
You will find an API with one main endpoint: a book list in JSON format. 
These are the opnional GET parameters that the API supports:

- `per_page`: number of books per page [Integer > 0]
- `page`: page to display [Integer > 0]
- `search`: string pattern for search in book's title and subject's name [String]
- `is_original`: Search based on original or based on another books [Integer 0 - 1]
- `subject`: Search by Subject's ID [Integer > 0]

## How are the books populated in the database if we do not have any POST method for add books?
The challenge provides a `books.json` file, in this case I put this file  in `database/seeders/data` folder.  
By running the Laravel's seeder action, all books will be populated in the database.


## Requirements

- Docker
- Docker Compose

## Setup Environment

### Steps

1. Clone this repository using GIT:

```
$ git clone https://github.com/Flormarys/pbtest.git
```
   
2. Change to the new folder

```
$ cd pbtest
```

3. Copy .env and .env.testing files from env-example

```
$ cp env-example .env
```

4. Replace if you want you can replace environment variables in .env file, just consider the `docker-compose.yml` file to keep environment consistences.

5. Get the necessary docker images and build those: `docker-compose build`. It couldtakes several minutes the first time. Next time you will use this API, you can avoid this step.

6. Up php (app), nginx (webserver) and mysql (db) containers: `docker-compose up`.

5. Install dependences
`docker-compose exec app composer install`

6. Generate Laravel Key
`docker-compose exec app php artisan key:generate`

7. Run MySQL DB Migrations
`docker-compose exec app php artisan migrate`

8. Populate Books from books.json provided file
`docker-compose exec app php artisan db:seed`


## Functional tests

### Running the test at the first time
The first time you run the test, you need to create the mysql test database manually and create a .env.testing file. Copy your `.env` file to a `.env.testing` file:
`$ cp .env .env.testing`

Now, replace DB_DATABASE environment variable for a new database name for run the test, for example: `DB_DATABASE=app_test`.  
Then, create a new database in your `mysql` container by running: 
```
docker-compose exec db mysql -uroot -proot
mysql> create database app_test;
```

### Running tests
Now you are able to run function tests by running: `docker-compose exec app php artisan test`
