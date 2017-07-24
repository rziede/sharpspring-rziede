# sharpspring-rziede

A temporary repository to host an interview project.

## Implementation Notes
* The requirements specifically call out Lumen and stateful session-based auth.
  * In a production project, I would use a framework auth library instead of directly manipulating sessions as I have done here.
  * Lumen is intended to be stateless. I would either use JWTs with Lumen, or switch to Laravel.
  * Laravel would obviate the usage of Handlebars.js in this project via blades.
  
* Since this is a disposable project, I directly included dependencies instead of setting up NPM/Bower etc. 
  * Makes hard-coded assumptions of _localhost_ purely for expedience.

* Developed and tested in _Apache 2.4_. A bug with Vagrant made using Homestead an issue in my local environment
  * https://github.com/mitchellh/vagrant/issues/2113

## Set Up Apache 2.4 Server
*Project may work in Homestead, but I cannot guarentee it. These steps are for Apache 2.4*
Update httpd.conf:
  `DocumentRoot "c:/Apache24/htdocs/sharpspring-project-rpz/public"`
  `ServerName localhost`
Clone the project. Ensure Lumen compatable PHP configuration.

## Create the Database 
Point MySql Command Line to `sharpspring-project-rpz`
`source sharpspringdb.sql`
Creates database 'c1', 'notes' table, and 'users' table.

## Seed the Database 
Point Command Line to `sharpspring-project-rpz`
`php artisan db:seed`

## Visit App
Navigate to:
http://localhost/index.php/login

## Seeded Users
email: test@test.com
pw: $sh4rpspr1nG$

email: joe@joe.com
pw: joe123

## Follow-up and Comments
Please email me if any issues arise. [rene.ziede@gmail.com]
If deploying the project is problematic, I can:
  1. Spin up a temporary server and host it online.
  2. Provide videos and screenshots of the app in action.
