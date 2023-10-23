## About Our Project
 --Cafeteria project is built using the Laravel framework as a full-stack solution, encompassing both User and Admin views. Users can securely log in, place orders for products, access their order history, and reset passwords if needed. Admins have the authority to create orders, manage products, users, and categories, review order and check histories, and oversee ongoing orders. The project incorporates features such as Facebook and Google sign-in, utilizes pagination for user convenience, and emphasizes a user-friendly and visually appealing interface. Additionally, there's an opportunity to enhance the project by implementing a payment method. Throughout the development, maintaining a comprehensive commit history on GitHub is crucial for version control and collaboration.

## Packages Installed
--Bootstrap
--Bootstrap icons
--Socialite
--Laravel ui
--Pagination


## OurTeam:
-Rewas Safawt
-Omar Ashraf
-Ibrahim Hesham
-Moataz Adel

## To Start the Web-application you need to follow the following commands:
```
git clone <repository_url>
composer install
npm install
copy the .env.example file To your Project
php artisan key:generate
php artisan storage:link
php artisan migrate
```
## you you need to replace the following lines of code within the .env file in your laravel project
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your username
MAIL_PASSWORD=your password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=your address
MAIL_FROM_NAME="${APP_NAME}"
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
```

## after writing these commands you should run the web-application you have to run the following two commands ---
```
npm run dev
php artisan serve
```


![6925898d-dcf5-4b43-8715-9044b05bef74](https://github.com/rewas20/cafeteria-laravel/assets/83989723/6ce37e52-4302-4d8a-a6e5-570183440650)

