
Setup after clone

-> Add env and create database
-> npm install
-> composer install
-> php artisan storage:link
-> sudo chmod -R 777 /public (give permission to public folder)
-> php artisan migrate:refresh --seed


-> Create Admin User

php artisan tinker

$user = new App\User;
$user->first_name = "admin";
$user->email = "rajneetkaur1511@gmail.com";
$user->password=bcrypt('123456');
$user->phone_number = "12221";
$user->is_admin = true;
$user->save();
