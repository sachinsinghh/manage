# manage

Step 1:
create PassportController.php file inside API folder using command php aritsan make:controller API\\PaspportController.

Step 2: Install passport library by following the installation steps mentioned in the link https://laravel.com/docs/5.6/passport.

Step 2: All the functions have been defined inside PassportController for our application.

Step 3: Create a MailNotification.php file using command php artisan make:notification MailNotification. 
Above command will generate a folder named Notifications inside app folder of the application.

write the statements which you want to send to registered user using toMail($notifiable) function which is available inside MailNotification.php file.

Step 4: Admin user has been created by using seeder feature of laravel. Please take a look in seeder file
use command :
php artisan make:seeder UsersTableSeeder

Above command file generate a file UsersTableSeeder inside seeds folder of database folder.

Use command to run seeder for to insert data:
composer dump-autoload
php artisan db:seed --class=PostsTableSeeder

Step 5: All the routes is available in api.php file which is inside the routes folder of the application.


Passport Controller Details:-
-----------------------------

1.login() -> login functionality for the users has been implemented inside it.
2.register() -> Register functionality for the users has been implemented inside it.
3.getDetails() ->Only Admin will fetch the details of user using this method.
4.filterDate() -> Admin will be able to filter records on the basis of provide date.
5.logout() -> This method will logout user.
6.submitAttendence() -> User will submit its attendence using this method.


Register Functionality:-
----------------------

User has to provide following details to register itself:
1.name
2.email
3.password
4.c_passoword

After successfull registration an E-mail will be send to user's e-mail for verification

Login Functionality:-
User has to provide followig details to login:
1.email
2.password

After successfull login ,user will get 'Token' from the application.
After that for every request to application user need to provide this token for authentication & authorization.

To send Token with every request , put following details in the requested header:
Authorization header : header "token"
Accept: application/json


