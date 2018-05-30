<?php

/**
 * redirect to specified function
 */
function redirect($url) {
    header( 'LOCATION: ' . APPURL . '/' . $url );
}