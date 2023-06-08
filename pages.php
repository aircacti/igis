<?php


// *****************************************
// *****************************************
//           Pages available for use
// *****************************************
// *****************************************


// Get page object
require_once('handle/page.php');

// Create array of pages
$pages = [];

// Add new page
$pages[] = new page('/', 'home', 'pages/home.html');
$pages[] = new page('/admin', 'Admin Login', 'pages/admin.html');




// *****************************************
// *****************************************
//          Helper functions for pages
// *****************************************
// *****************************************


function findPageByUri($pages, $uri)
{
    foreach ($pages as $page) {
        if ($page->getUri() == $uri) {
            return $page;
        }
    }
    return null;
}
