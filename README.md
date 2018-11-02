# manage

Step 1:
create PassportController.php file inside API folder using command php aritsan make:controller API\\PaspportController.

Step 2: Install passport library by following the installation steps mentioned in the link https://laravel.com/docs/5.6/passport.

Step 2: All the functions have been defined inside PassportController for our application.

Step 3: Create a MailNotification.php file using command php artisan make:notification MailNotification. 
Above command will generate a folder named Notifications inside app folder of the application.

write the statements which you want to send to registered user using toMail($notifiable) function which is available inside MailNotification.php file.

Step 4: Admin user has been created by using seeder feature of laravel. Please take a look in seeder file.

Use command to run seeder for to insert data about admin:
composer dump-autoload
php artisan db:seed --class=PostsTableSeeder

Step 5: All the routes is available in api.php file which is inside the routes folder of the application.
