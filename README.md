# UOttawaNightLife

uOttawaNightLife
A data-driven web application built with PHP and MySQL that allows users to create profiles, add and view events, rate events, and search for events. This project is part of a group assignment and demonstrates server-side scripting, session management, and database interactions.

Overview
This project provides the following features:
User Registration & Login: Users can create an account and log in.
Event Creation: Authenticated users can add new events.
Event Rating & Reviews: Users can rate and comment on events.
Event Search: Users can search for events by title, location, or date.

Requirements
XAMPP (or any equivalent PHP & MySQL environment)
PHP 7.x or later
MySQL or MariaDB
A modern web browser

Installation & Setup
Clone the Repository:
git clone <repository_url>

Place the Repository in XAMPP:
Copy the repository folder (e.g., uOttawaNightLife) into your XAMPP htdocs directory, typically located at:
C:\xampp\htdocs\

Start XAMPP Services:

Open the XAMPP Control Panel and start both Apache and MySQL.

Set Up the Database:

Open your web browser and navigate to phpMyAdmin.
Create a new database named uottawa_nightlife:
Click New in the left sidebar.
Enter uottawa_nightlife as the database name.
Click Create.
Import the Database Schema:
Click on the uottawa_nightlife database in the left sidebar.
Click the Import tab.
Click Choose File and select the database.sql file located in the db/ folder of this project.
Click Go to import the database.
Test the Setup:

Open your browser and visit:
http://localhost/uOttawaNightLife/public/test_connection.php
If you see a success message, the connection to the database is working.


Directory structure:

uOttawaNightLife/
├── db/
│   └── database.sql       # SQL file to set up the database schema
├── includes/
│   ├── config.php         # Database connection configuration
│   ├── session.php        # Session management
│   └── functions.php      # Helper functions
├── public/
│   ├── index.php          # Main page
│   ├── create_profile.php # User registration page
│   ├── login.php          # User login page
│   ├── create_event.php   # Event creation page
│   ├── search_events.php  # Event search page
│   ├── ratings_review.php # Ratings and reviews page
│   └── test_connection.php# Page to test database connection
└── README.md              # This file

Usage
Register a New User:
Navigate to http://localhost/uOttawaNightLife/public/create_profile.php to create a new account.

Log In:
After registration, log in via login.php.

Create & Manage Events:
Use the provided forms to add events and review existing events.

Search for Events:
Search for events using the search functionality.