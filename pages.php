<?php


// *****************************************
// *****************************************
//           Pages available for use
// *****************************************
// *****************************************


// Get page object
require_once($path . '/handle/page.php');

// Create array of pages
$pages = [];

// Add new page
$pages[] = new page('/', 'home', $path . '/pages/home.html');
$pages[] = new page('/admin', 'Admin Login', $path . '/pages/admin.html');
$pages[] = new page('/test', 'Test', $path . '/layouts/common_layout.php');
