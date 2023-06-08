<?php


// *****************************************
// *****************************************
//             Find translation
// *****************************************
// *****************************************


function translate($langCode, $messageKey)
{
    // The translation comes from the translations file
    require_once(__DIR__ . '/../translations.php');

    // Check if there is a translation
    if (isset($translation[$messageKey][$langCode])) {
        echo $translation[$messageKey][$langCode];
    } else {
        echo 'Missing translation';
    }
}
