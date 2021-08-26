
## About SkillWork-Task

PHP Developer with Laravel / Mid Level B1 /
As Developer,
you have to prepare a simple Laravel based API which will have the following requirements. All the best practices that you are familiar with are
must.
1. Register the user though the API
   a. Input fields:
   i. Fullname
   ii. Email
   iii. Password
   iv. Confirm password
   b. Validate the request in the best way that you can do it. Please make sure that the given request is absolutely secured
   c. Send an confirmation email with some link which hash would be used as a reference to confirm the user’s entity into database
2. I have to create a token based Authentication in order to secure all the endpoints which needs user’s reference
   a. When the user get the login, we need to return the representation of the logged user and his own data
   b. I have to return a token or cookie with the token
3. I have to prepare a “Confirmation endpoint” which the main purpose is to validate the hash received by the “Confirmation
   Email”
4. I have to prepare Logout functionality
5. Create an Endpoint which create an Article with the following requirements:
   a. follow the following fields:
   i. Title
   ii. Content
   iii. Author (The author is the logged user)
   b. Secure the endpoint by Auth
   c. Secure the endpoint by CRSF
6. Create an endpoint with list of all the articles by pagination of 10 items with the overall information:
   a. Author,
   b. Title
   c. Date of publication
   d. Date of last update
7. Create an endpoint which give you detailed view of the Article
8. Nice to have would be some unit testing

## How to use project
There are few steps to take to use project.

0. Prerequisites: PHP, MySQL, Apache2

1. Download composer installer.

   `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`

2. Install composer.

   `php composer.phar`

   `php composer-setup.php --install-dir=bin --filename=composer`

3. Install laravel

   `composer global require laravel/installer`

4. Clone the skillwork-task repo

   To run project with apache2 the repo must be in `/var/www/html`

   `cd /var/www/html`

   `https://github.com/LadyVamp227/skillwork-task.git`

5. Go to the downloaded repository.

   `cd skillwork-task`

6. Run composer to install packages.

   `composer install`

   1. To use database config the .env.example:

      Rename `.env.example` to `.env`

      After that open the `.env` file and fill the following lines like:

            APP_URL=http://localhost  <-- Where replace localhost with the real host ip for the app
        
           `DB_CONNECTION=mysql`

           `DB_HOST=localhost`

           `DB_PORT=3306`

           `DB_DATABASE=laravel`

           `DB_USERNAME=` <-- here after `=` write username for the database

           `DB_PASSWORD=` <-- here after `=` write password for the database 
           `MAIL_MAILER=smtp`
           `MAIL_HOST=smtp.mailtrap.io`
           `MAIL_PORT=2525`
           `MAIL_USERNAME=` <-- here after `=` write username for the mailtrap.io
           `MAIL_PASSWORD=` <-- here after `=` write password for the mailtra.io

7. Generate encryption key

   `php artisan key:generate`

## To run project with apache web server:

Laravel is tricky. It is because the main index.php file of the project resides in the public directory of the project. It means that we have to update our virtual host in such a way that it should route the traffic into the public directory inside our project directory.

To open your virtual host file in edit mode, execute the following command.

`sudo nano /etc/apache2/sites-available/000-default.conf`

Do not forget to replace 000-default.conf with the name of your virtual host file if you are using multiple virtual hosts on your server. Now, add /public at the end of the document root so that Apache will route all the traffic inside the /public route that holds the main index.php file of our project.

For example, Here is the updated default virtual host configuration file without comments.

`sudo cp /etc/apache2/sites-available/000-default.conf /etc/apache2/sites-available/skillwork.conf`

    NameVirtualHost *:8080
    Listen 8080
     
    <VirtualHost *:8080>
        ServerAdmin admin@example.com
        ServerName skillwork.dev
        ServerAlias www.skillwork.dev
        DocumentRoot /var/www/html/skillwork-task/public
         
        <Directory /var/www/html/skillwork-task/public/>
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
                Require all granted
        </Directory>
         
        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined
    </VirtualHost>

Then run `sudo service apache2 restart`

Add new virtual host to hosts file.

`sudo nano /etc/hosts`

     127.0.0.1  skillwork.dev -> Where the ip is the server ip
`sudo a2ensite skillwork.conf`

You’ll be prompted to reload the Apache server process. However, before we do that, we (optionally) may want to disable the default Apache configuration. Again, if you have other web applications, such as phpMyAdmin, running on your machine, you do not want to disable this configuration. Otherwise, to avoid confusion, it probably makes sense to disable it:

`sudo a2dissite 000-default.conf`

`sudo services apache2 restart`
