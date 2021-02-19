# Pre-screening challenge for PressBooks

I created this repo for practicing and learn with the requiredment of a real company. In this challenge, you will find an API with one main endpoint: a book list in JSON format. 
This is the opnional GET parameters that the API supports:

`
per_page
`
`
page
`
`
search
`
`
is_original
`
`
subject
`


## Requirements

[pbtest-docker](https://github.com/Flormarys/pbtest-docker.git)

Setup Environment

### Steps

1. Clone this repository using GIT:

`
$ git clone https://github.com/Flormarys/pbtest.git
`
   
2. Change to the new folder

`
$ cd pbtest
`

3. Create in the same path .env file using env-example

`
$ cp env-example .env
`

4. Replace DB variables (and others required) taking into account the pbtest-docker env variables

5. Install dependences

Enter to workspace docker container (Make sure you have the pbtest-docker project running) docker-compose exec --user=laradock {workspace_repo} /bin/bash , where {workspace_repo} is the workspace container declared in .env file, by default it is workspace.
Inside the container, run composer to install PHP dependences: 

```
$ composer install
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
```
To exit just type exit.
