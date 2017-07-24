# sharpspring-rziede

A temporary repository to host an interview project.

## Implementation Notes
* The requirements specifically call out Lumen and stateful session-based auth.
  * In a production project, I would use an auth library instead of directly manipulating sessions as I have done here.
  * Lumen is intended to be stateless/state-light. I would either use JWTs with Lumen, or switch to Laravel.
  * Laravel would obviate the usage of Handlebars.js in this project via blades.
* Since this is a disposable project, I directly included dependencies instead of setting up NPM/Bower etc. 
* Developed and tested in Apache 2.4. A bug with Vagrant made using Homestead an issue in my local environment
  * https://github.com/mitchellh/vagrant/issues/2113
* Makes hard-coded assumptions of localhost for expedience and to get to the good stuff. I know this is bad.

## Create the Database 
Point MySql Command Line to `sharpspring-project-rpz`
`source sharpspringdb.sql`
Creates database 'c1', 'notes' table, and 'users' table.

## Seed the Database 
Point Command Line to `sharpspring-project-rpz`
`php artisan db:seed`

## Seeded Users
email: test@test.com
pw: $sh4rpspr1nG$

email: joe@joe.com
pw: joe123
