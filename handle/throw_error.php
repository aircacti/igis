<?php


// *****************************************
// *****************************************
//          Versatile support functions
// *****************************************
// *****************************************


function throw_error($code = 0, $description = null)
{
    $config = config::getInstance();

    if ($config->debug) {
        echo 'Error ' . $code . ' ' . $description;
    } else {
        if (!file_exists('pages/basic_error.html')) {
            echo '<p>Something gone wrong! Please return to previous page!</p> <p hidden>Error: 1</p>';
            exit;
        }
        echo file_get_contents('pages/basic_error.html');
    }
}
