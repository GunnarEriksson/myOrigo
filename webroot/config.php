<?php
/**
 * Config-file for Origo. Change settings here to affect installation.
 *
 */

/**
 * Set the error reporting.
 *
 */
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly


/**
 * Define Origo paths.
 *
 */
define('ORIGO_INSTALL_PATH', __DIR__ . '/..');
define('ORIGO_THEME_PATH', ORIGO_INSTALL_PATH . '/theme/render.php');


/**
 * Include bootstrapping functions.
 *
 */
include(ORIGO_INSTALL_PATH . '/src/bootstrap.php');


/**
 * Start the session.
 *
 */
session_name(preg_replace('/[^a-z\d]/i', '', __DIR__));
session_start();


/**
 * Create the Origo variable.
 *
 */
$origo = array();


/**
 * Theme related settings.
 *
 */
$origo['stylesheets'][] = 'css/style.css';
$origo['favicon']       = 'img/favicon/favicon.ico';


/**
 * Site wide settings.
 *
 */
$origo['lang']         = 'sv';
$origo['title_append'] = ' | Rental Movies';

/**
 * The header for the website.
 */
$origo['header'] = <<<EOD
EOD;

/**
 * The webpages for this website. Used by the navigation bar.
 */
$menu = array(
    // Use for styling the menu
    'class' => 'navbar',

    // The menu structure
    'items' => array(
        // Home menu item
        'home'  => array(
            'text'  =>'Hem',
            'url'   =>'index.php',
            'title' => 'Hem'
        ),

        // Movies menu item
        'movies'  => array(
            'text'  =>'Filmer',
            'url'   =>'movie.php',
            'title' => 'Filmer'
        ),

        // News menu item
        'news'  => array(
            'text'  =>'Nyheter',
            'url'   =>'news_blog.php',
            'title' => 'Nyheter'
        ),

        // Calendar menu item
        'calendar'  => array(
            'text'  =>'Kalender',
            'url'   =>'calendar.php',
            'title' => 'Kalender'
        ),

        // Game menu item
        'dice'  => array(
            'text'  =>'Tävling',
            'url'   =>'dice.php',
            'title' => 'Tävling'
        ),

        // About RM menu item
        'about'  => array(
            'text'  =>'Om RM',
            'url'   =>'about.php',
            'title' => 'Om RM'
        ),

        // Login menu item is only shown in navigation bar when no user has logged
        // in.
        'login'  => array(
            'text'  =>'Logga in',
            'url'   =>'login.php',
            'title' => 'Logga in'
        ),

        // Account menu item is only shown for a user who has logged in and user
        // is not admin. If no user has logged in, the login item is shown in
        // the navigation bar.
        'account'  => array(
            'text'  =>'Konto',
            'url'   =>'',
            'title' => '',

            // Submenu, with some menu items, as part of a existing menu item
            'submenu' => array(

                'items' => array(
                    // Profile menu item of the submenu
                    'item 1'  => array(
                        'text'  => 'Profil',
                        'url'   => 'user_profile.php',
                        'title' => 'Profil'
                    ),

                    // Logout menu item of the submenu
                    'item 2'  => array(
                        'text'  => 'Logga ut',
                        'url'   => 'logout.php',
                        'title' => 'Logga ut',
                    ),
                ),
            ),
        ),

        // Admin menu item is only shown for a user who has logged in as admin.
        // If no user has logged in as admin, the login item is shown in the
        // navigation bar.
        'admin'  => array(
            'text'  =>'Admin',
            'url'   =>'',
            'title' => '',

            // Submenu, with some menu items, as part of a existing menu item
            'submenu' => array(

                'items' => array(
                    // Proflie menu item of the submenu
                    'item 1'  => array(
                        'text'  => 'Profil',
                        'url'   => 'user_profile.php',
                        'title' => 'Profil'
                    ),

                    // Account menu item of the submenu
                    'item 2'  => array(
                        'text'  => 'Konton',
                        'url'   => 'user_admin.php',
                        'title' => 'Konton'
                    ),

                    // Logout menu item of the submenu
                    'item 3'  => array(
                        'text'  => 'Logga ut',
                        'url'   => 'logout.php',
                        'title' => 'Logga ut',
                    ),
                ),
            ),
        ),
    ),

    // This is the callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
            return true;
        }
    }
);

 /**
 * Settings for the database.
 */
if (isset($_SERVER['REMOTE_ADDR'])) {
    if($_SERVER['REMOTE_ADDR'] == '::1') {
        $origo['database']['dsn']            = 'mysql:host=localhost;dbname=Rm_Movie;';
        $origo['database']['username']       = 'root';
        $origo['database']['password']       = '';
        $origo['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
    } else {
        define('DB_PASSWORD', 'uiJ7A6:g');
        $origo['database']['dsn']            = 'mysql:host=blu-ray.student.bth.se;dbname=guer16;';
        $origo['database']['username']       = 'guer16';
        $origo['database']['password']       = DB_PASSWORD;
        $origo['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
    }
}

/**
 * The footer for the webpages.
 */
$origo['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Rental Movies | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
