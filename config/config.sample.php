<?php
/**
 * This file is used to en/disable which modules of EasyMVC Core are
 * going to be used in the project
 *
 * @version 2.0.0
 */

/**
 * Set this to true of you are going to use a database in your project
 * You can configure your database(s) in the config/database.php file
 * Use config/database.local.php for you local database (test server)
 */
const USE_DATABASE = false;

/**
 * Set USE_LOGIN to true if you want to use the EasyMVC login system
 * Set USE_EMAIL_LOGIN to true if you want to use the E-mail address to login with
 *                     or to false if you want to use an Username to login with
 */
const USE_LOGIN = false;
const USE_EMAIL_LOGIN = false;

/**
 * Set this to true is you are planning to get information from a WebApi
 */
const USE_HTTP_REQUEST = false;

/**
 * Set this to true if you want to use the EasyMVC Menu system
 */
const USE_MENU = false;

/**
 * Set USE_EMAIL to true if you want to use the EasyMVC E-mail system
 * Set USE_SMTP to true if you want to use your personal SMTP server instead of the one used by your hosting server
 */
const USE_EMAIL = false;
const USE_SMTP = false;

// Your SMTP Configuration
const EMAIL_HOST = 'smtp.server.com';
const EMAIL_FROM = 'your@email.address';
const EMAIL_BCC = 'bcc@email.address'; // Set this to null is you don't want to receive copies of the e-mails send
const EMAIL_USERNAME = 'username_login';
const EMAIL_PASSWORD = 'password_login';
const EMAIL_SECURITY = 'ssl';
