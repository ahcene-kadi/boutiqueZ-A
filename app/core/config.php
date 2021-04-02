<?php

define("WEBSITE_TITLE", 'MY SHOP');

//database name
define('DB_NAME', "boutique_db");
define('DB_USER', "root");
define('DB_PASS', "root");
define('DB_TYPE', "mysql");
define('DB_HOST', "localhost");



define('THEME', 'eshop/');

define('DEBUG', true);

if (DEBUG) {

    ini_set('display_errors', 1);
} else {
    ini_set('display_errors', 0);
}
