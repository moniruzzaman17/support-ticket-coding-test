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
8. To enable email functionality, configure the mail settings in your .env file. Here's an example setup for Gmail:
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
9. Run the migrations to create tables in your database: "php artisan migrate"
10. Run the seeder to populate the database with test data: "php artisan db:seed"
11. Run the following command to start the Laravel development server: "php artisan serve"

Congratulations you have successfully done.