<?php
// Load configurations
require_once 'config/config.php';
require_once APPROOT . '/helpers/session.php';
require_once APPROOT . '/helpers/nav_item_creator.php';
require_once APPROOT . '/helpers/url_navigation.php';

// Lead libraries
spl_autoload_register( function( $className ) {
    require_once 'libraries/' . $className . '.php';
});


$core = new Core();