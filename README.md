## Wedding Registry
This is a laravel project. 
https://laravel.com/docs/7.x

It utilizes vueJS for the frontend with vuetify as the component library
https://vuetifyjs.com/en/introduction/why-vuetify/

This is stored on github https://github.com/ddell003/wedding-registry

This is hosted live at: https://parker-and-katie.herokuapp.com/

### Getting Started

#### For windows
1. Install xampp https://divpusher.com/blog/how-to-run-laravel-on-windows-with-xampp/
2. Install xamp and point it to the php.exe inside of xampp
3. Place code or do git clone of repo into the htdocs


1. ```composer install```
2. ```cp .env-example .env```
3. ```php artisan config:cache```
4. set up the .env variables (includes setting up database credientials)
    - For testing locally just use sqlite ```touch /database/database.sqlite```
5. Run Migrations to populate database ```php artisan migrate```
6. Create an account user ```php artisan user:create --first_name=Parker --last_name=Dell --email=parkerdell94@gmail.com --password=testtest --admin=1```
7. Get the api_token to use in postman ```php artisan user:get --id=1```
8. Set up the frontend ``npm install`` followed by ```npm run watch``` watch can be exchanged for dev or production

### Using the API
The frontend uses the backend REST JSON/XML API. The response type can be specified in the header as Accept = application/xml.
The API return json as the default. To return data as XML the API uses the library https://github.com/mtownsend5512/response-xml. 

To see the list of endpoints, import the post man collection found in the root of the project. To use the API, you need to be an authenticated user. 
If you followed the previous steps, you made an admin user and you can run the console command listed above to retrieve you API token. 
Once you have the token, format your headers with the KEY "Authorization" and the value "Bearer {{API token}}"

#### Example Curl Request:
```$xslt
curl --location --request GET 'http://127.0.0.1:8000/api/meal' \
--header 'Authorization: Bearer 4bb95RXAeuXM1BM3gkG0Hf7eVAodYBtl8v5votNkcOKcCCclcKdcfBeeke6gc2REOaEjk2KntZOn4LSW' \
--header 'Accept: application/xml'
```

### Architecture
#### Api
The API utilizes a Service Repository Pattern. 

So laravel utilizes MVC has a router which basically say given a url and method ex. GET users, direct them to a controller. 
The controller then determines which service needs to be called. Services hold all the business logic and abstract it out to reusable/callable code.
This came in handy when the api/PartyController needed to know party information and the RsvpController needed to get party information as well. 
Instead of having duplicate logic, it has been abstracted out to the PartyService. The services then perform the various business logic 
such as determining if a user is allowed to perform an action and other process such as deciding how to "RSVP" a user. To interact with the databases, 
the service calls a repository which sits on top of the model which directly interacts with the database. The repository contains information 
pertinent to the database. The repositories extend my base repository class which contains all the CRUD logic. Thus the individual libraries 
are very simple but allow you to introduce specific complex logic as needed.  

## Deployments

I am using Heroku as my server
https://www.heroku.com/

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
### Setting Up .env Variables in Heroku
https://devcenter.heroku.com/articles/config-vars
``````
$ heroku config
$ heroku config:set DB_CONNECTION=pgsql
$ heroku config:set DB_PASSWORD='password'
$ git push heroku master
``````
### Running Migrations
``````
$ heroku run bash 
$ php artisan migrate
$ php artisan user:create --first_name=Parker --last_name=Dell --email=parkerdell94@gmail.com --password=testtest --admin=1
``````
