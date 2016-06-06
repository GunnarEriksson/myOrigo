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
$origo['title_append'] = ' | Origo Boilerplate';

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

        // Menu with submenu
        'item'  => array(
            'text'  =>'Item',
            'url'   =>'',
            'title' => 'Item',

            // Submenu, with some menu items, as part of a existing menu item
            'submenu' => array(

                'items' => array(
                    // Profile menu item of the submenu
                    'item 1'  => array(
                        'text'  => 'Item 1',
                        'url'   => '',
                        'title' => 'Item 1'
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
        $origo['database']['dsn']            = 'mysql:host=localhost;dbname=;';
        $origo['database']['username']       = 'root';
        $origo['database']['password']       = '';
        $origo['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
    } else {
        define('DB_PASSWORD', '');
        $origo['database']['dsn']            = 'mysql:host=;dbname=;';
        $origo['database']['username']       = 'userName';
        $origo['database']['password']       = DB_PASSWORD;
        $origo['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
    }
}

/**
 * The footer for the webpages.
 */
$origo['footer'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Origo | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
