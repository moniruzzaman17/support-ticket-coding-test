Project Setup and Running Locally
This guide will walk you through the steps needed to set up and run the project on your local machine.

Prerequisites
Before start, make sure you have the following installed:
PHP (>= 8.1)
Composer
MySQL
Git

Steps to Run the Project Locally
Follow these steps to get the project up and running:
1. Clone the Repository
2. Navigate into the project directory
3. Install PHP Dependencies using "composer install"
4. Copy the .env.example file to create a .env file: "cp .env.example .env"
5. Generate a key for your Laravel application by running: "php artisan key:generate"
6. Create a new database in your MySQL (or other DBMS). For example, in MySQL
7. Update your .env file to configure your database settings
8. Run the migrations to create tables in your database: "php artisan migrate"
9. Run the seeder to populate the database with test data: "php artisan db:seed"
10. Run the following command to start the Laravel development server: "php artisan serve"

Congratulations you have successfully done.