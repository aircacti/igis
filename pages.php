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
$pages[] = new page('/test', 'Test', 'layouts/common_layout.php');


