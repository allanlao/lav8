Department of Education, HR System


Installation Requirements:

1. <a href="https://git-scm.com/download">git</a> - for cloning the repository
2  <a href="https://www.npmjs.com/get-npm">Node.js and npm</a> - package manager for JS components
3  <a href="https://getcomposer.org/download/">Composer</a> - package manager for PHP components
4. MySQl Server / PHP / Webserver


Installation :

1. Git clone the repository to your www folder

   git clone https://github.com/allanlao/lav8.git

2. change directory to lav8

//install dependencies
3. npm install
4. composer install

5. Edit .env file and change database name
//migrate database to the assigned database name
6. php artisan migrate
//create a default admin user
// user@exmaple.com

DONE!

7. Run the service
php artisan serve
8. open in browser  http://localhost:8000






