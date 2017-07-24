#sharpspring-rziede

A temporary repository to host an interview project.

##Implementation Notes

    The requirements specifically call out Lumen and stateful session-based auth.
    In a production project, I would use a trusted auth library instead of manually manipulating sessions as I have done here.
    Lumen is intended to be stateless/state-light. I would either use JWTs with Lumen, or switch to Laravel.
    Laravel would obviate the usage of Handlebars.js in this project via blades.

##Create the Database something something

##Seed the Database php artisan db:seed
