## Introduction

RosterMe is a web application which handles the roster management system for the organization Spot On Global. 

Some of the basic functionality of the web application is:
- The ability for the web administrator to create, update, and delete accounts for the all the users.
- The ability for the manager to create, update, and delete accounts for the staff.
- The ability for the manager and staff to log in, log out, update profile information, and reset the passwords for their respective accounts.
- The ability for the manager to create, update, view, and delete rosters. A roster will include start time, end time, and assigned department.
- The ability for the staff to view their roster assigned by the manager.
- The ability for the staff to clock in and clock out from the application which will be recorded as their shifts.
- The ability for the manager to approve, view, edit, and delete a staff's shift.
- The ability for the staff to view their shift details.

The application development environment consists of:
- HTML and JavaScript has been used for front end development.
- PHP and mySQL has been used for back-end development.
- Laravel is the web application framework that will be used for backend development.
- Tailwind CSS has been used for front end User Experience and User Interface designs.

Software Requirements:
- XAMPP: version 8.1.2
- Apache (XAMPP):  version 2.4.52
- PHP(XAMPP): version 8.1.2.0
- phpMyAdmin: version 5.1.3
- MySQL: version 8.0.28
- Tailwind CSS: version 3.0
- Laravel Framework: Laravel 9
- Google Chrome: 99.04844.51
- Firefox: 98.0.1
- Safari: 15.3


## Installation


Clone the repository

    git clone https://git.infotech.scu.edu.au/scm/itpa122/itp-122-gconline-team2.git

Switch to the repo folder

    cd itp-122-gconline-team2

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000