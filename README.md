

## Notification Test

The notification system has the ability to receive a message and depending on the
category and subscribers, notify these users in the channels they are registered.

It has 3 message categories:

- Sports
- Finance
- Movies

There are 3 types of notifications, each type have its own class to manage the logic of
sending the message independently.

- SMS
- E-Mail
- Push Notification

No message is actually sent nor communicate with any external APIs, only register
the sent notification in a database log.

In the log, it's saved all the information necessary to identify that the notification has been
sent correctly to the respective subscriber: type of message, type of notification, user data & time.

Users have the following information:

- ID
- Name
- Email 
- Phone number 
- Subscribed [ ] here you need to list all the categories where the user is subscribed 
- Channels [ ] a list of the notification's channels (SMS | E-Mail | Push Notification)

As user interface 2 main elements are displayed:

1. Submission form. A simple form to send the message, which have 2 fields:
- Category. List of available categories.
- Message. Text area, only validates that the message is not empty.
2. Log history. A list of all records in the log, sorted from newest to oldest

## Requirements

- MySQL >= 8.0.29
- Composer 2
- PHP >= 8.0 
- npm >= 8.9 
- git >= 2.37

## Installation

1. Create database
2. Clone repo from public github project

``git clone https://github.com/esoriams/notifications.git``

3. Move into the folder project

``cd notifications``

4. Install laravel dependencies

``composer install``

5. Create configuration file by copying ``.env.example`` into ``.env``

``cp .env.example .env``

6. Open copy ``.env``  file and set the url server and the database credentials, e.g:
   
   - APP_URL=http://127.0.0.1:8000
   - DB_DATABASE=notifications
   - DB_USERNAME=dbuser
   - DB_PASSWORD=userpassword

7. Execute migrations and seed to create database schema

``php artisan migrate --seed``

8. Install NPM Dependencies, Vue.js 3, vitejs/plugin-vue plugin & compile the assets

``npm install && npm install vue@next vue-loader@next && npm i @vitejs/plugin-vue && npm run build``

9. Start Laravel server in one console window

``php artisan serve``

...Ready to use it :)

## How to use it

Main url is kind of ``http://127.0.0.1:8000/``, depends on your local configuration. 

The system has been developed to consume the web api internally, so you can check it all of them by launching the command:

``php artisan route:list``
