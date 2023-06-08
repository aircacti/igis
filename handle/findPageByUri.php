<?php

// *****************************************
// *****************************************
//          Helper functions for pages
// *****************************************
// *****************************************


function findPageByUri($uri)
{
    global $pages;

    foreach ($pages as $page) {
        if ($page->getUri() == $uri) {
            return $page;
        }
    }
    return null;
}
