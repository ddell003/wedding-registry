## Wedding Registry
This is a laravel project. 
### Getting Started
1. ```~ composer install```
2. ```cp .env-example .env```
3. set up the .env variiables (includes setting up database credientials)
    - For testing locally just use sqlite
4. Run Migrations to populate database ```~ php artisan migrate```
5. Create an account user ```php artisan user:create --first_name=Parker --last_name=Dell --email=parkerdell94@gmail.com --password=testtest --admin=1```
6. Get the api_token to use in postman ```php artisan user:get --id=1```

## Deployments
Install the Heroku CLI
Download and install the Heroku CLI.

If you haven't already, log in to your Heroku account and follow the prompts to create a new SSH public key.

```$ heroku login```
Clone the repository
Use Git to clone parkersbookstore's source code to your local machine.

`````
$ heroku git:clone -a parkersbookstore
$ cd parkersbookstore
`````
Deploy your changes
Make some changes to the code you just cloned and deploy them to Heroku using Git.
``````
$ git add .
$ git commit -am "make it better"
$ git push heroku master
``````
