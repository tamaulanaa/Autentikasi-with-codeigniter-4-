# Authentikasi with codeigniter 4

A simple Auth library for Codeigniter 4

SimpleAuth is small lightweight Auth library for Codeigniter 4 with powerfull features

Designed to be easy to instal, customise and expand upon. Using a modular approach its easy to to use all of the library or just the bits you need making it very flexible and easy to integrate.

## Features

- User Registration
- User Activation Email
- User Login
- User Forgot Password
- User reset password
- Basic Bootstrap Starter Template

## Manual Instalation

- Download or clone the repo to your desktop or www folder.
- Change directory to cd my-app in your www folder.
- Import my-app/database.sql to your MySQL or MariaDB Server, create a user and grant all rights to the imported DB
- Rename .env.example to .env
- Change the App URL to app.baseURL = 'http://localhost/my-app/public/'
- Update database config, change the lines where database.default.database =, database.default.username =, database.default.password =, and database.default.hostname = in .env file.
- Run php spark serve to serve live application in the terminal.
- Alternatively, you can browse the app using a web browser, by entering this URL address http://localhost/my-app/public.
- Login using default account username triahmadmaulana0@gmail.com, password Bokir2004

## Composer Instalation

- Composer Instalation coming soon

Dowload the package and extract into your project route. There are no files that will be overwritten (Except for BaseController.php If you already have custom code inside your BaseController just add the helpers manually) we will change other files manually so this can be dropped into an existing project without messing everything up.

### Import Database

Create your database and import

```
db_ci4.sql
```

### Email Config

SimpleAuth comes with a small email sending library to automatically set the email headers and parse a template file. In order for emails to work you need to ensure you have the fromEmail and fromName set in your Email config file

```
app/config/Email.php
```

### Load Helpers

Simple auth uses some of Codeigniters helpers so we need to auto load them. These are loaded in the BaseController.php The included BaseControler already has these set for you.

```
public $helpers = ['form', 'array'];
```

## Define Routes

An example Routes config file is included. You can use this as a starter Routes file on fresh instalations. The majority of SimpleAuths features rely on your routes being properly set up and defined. The use of filters will manage your application. Filters are already set up to ensure users are logged in or have the correct roles. The filters will work for most projects but can be modified or extended if needed.

All of SimpleAuths 'Auth' routes that route through to the example Auth Controller are already set up. There is no need to modify these unless you are using a custome Auth Controller. These routes control the Login, Logout, Register, Reset Password etc.

The default routes are

```
$routes->get('/', 'Home::index');
$routes->group('', static function ($routes) {
    $routes->get('/register', 'Auth::index');
    $routes->post('/user/save', 'Auth::save');
    $routes->get('/login', 'Auth::Login');
    $routes->post('/user/masuk', 'Auth::login_action');
    $routes->get('/dashboard', 'Dashboard::index');
    $routes->get('/login/logout', 'Auth::Logout');
    $routes->get('/forgot', 'Auth::forgot', ['as' => 'forgot']);
    $routes->post('/forgot/forgotPassword', 'Auth::forgotPassword');
    $routes->get('/forgot/reset/(:any)', 'Auth::reset/$1', ['as' => 'reset']);
    $routes->post('/forgot/resetpassword/(:any)', 'Auth::resetPassword/$1');
    $routes->get('/register/actived/(:any)', 'Auth::actived/$1');
});
```

### Send Reset Email

If Your reset password, SimpleAuth will send an email requesting the user to confirm their email address by clicking on an reset link. We can also specify the time before the Forgot password tokens expire. By default the reset email token has an expiry of 24 hours and the password rest 1 hour.

### Hash Algorithm

As Codeigniter 4 needs a min of PHP 7.2 we should be using the latest standards where possible. SimpleAuth uses the ARGON2ID hashing algorithm by default. This requires PHP 7.3 and must have been compiled with Argon2 support.

It is reccomended to use Argon2 where possible but you can also use :

- - PASSWORD_DEFAULT
- - PASSWORD_BCRYPT
- - PASSWORD_ARGON2I - As of PHP 7.2
- - PASSWORD_ARGON2ID - As of PHP 7.3 (default)

# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

You can read the [user guide](https://codeigniter.com/user_guide/)
corresponding to the latest version of the framework.

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the _public_ folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's _public_ folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter _public/..._, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

> [!WARNING]
> The end of life date for PHP 7.4 was November 28, 2022.
> The end of life date for PHP 8.0 was November 26, 2023.
> If you are still using PHP 7.4 or 8.0, you should upgrade immediately.
> The end of life date for PHP 8.1 will be November 25, 2024.

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
