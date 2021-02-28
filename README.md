# About this repo

I created this repo for practicing and learning about Laravel, PHP and OOP practices.
I took this challenge from a pre screening test that belongs to a Canadian company for a Full Stack PHP Developer position.
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

## What was my goal on this project?
First of all, learn. Mainly in my case by asking to another colleagues with more experiencies, getting feedback from them and reading blogs, tutorials and official docs (mainly from Laravel and PHP).  

### Iterating the solution
When I got the API at the first time working and after reading some practices I went for tests. I was an interesting challenge, from thinking about cases and how to implement those. Fortunately other colleagues helped me by sending me intresting links and with some test cases examples to implement.  
I would say the most challenging parts were the tests and the Resources for JSON responses.  
The following steps I took, implied that I ran the tests after each change to ensure the API continued working as expected by the tests. Although honestly, the docker understanding was a incredible travel. I was interesting and a friend had to help closely.  

I noticed my Book controller was big, the whole logic was there. So, I moved the business logic to the Model.  
But then, I realized I had a big function in the Model. It didn't look nice, then I divide into parts, in that way I made sure each function does only 1 thing.  
About the seeder which is responsible for reading and importing books and subject data, I was inserting one by one in the database when I was iteraring the books json array. I had to find a way to insert all books and subjects once in order to reduce DB operations.

Finally, I did several adjustments related to functions and variables naming, code structure and those kind of things.

I received some feedback after the implementation, I know each code an be improved to the infinite, but I think it is enough for me to prove I can learn and implement something from scratch. I will move on to another project, with a little bit more of complexity with my main goal in sight: **find a new job where I can continue learning by experienced people and making customers happier.**


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
