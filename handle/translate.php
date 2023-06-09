<?php


// *****************************************
// *****************************************
//             Find translation
// *****************************************
// *****************************************



function translate($messageKey, $langCode = null)
{
    // The translation comes from the translations file
    require_once(PATH . '/translations.php');


    // Get request informations
    require_once(PATH . '/handle/request.php');
    global $request;

    // Get config informations
    require_once(PATH . '/config.php');
    global $config;

    if ($langCode == null) {
        $langCode = $request->language;
    }

    // Check if there is a translation
    if (isset($translation[$messageKey][$langCode])) {
        echo $translation[$messageKey][$langCode];
    } else {
        if ($config->missingTranslation) {
            echo 'Missing translation';
        } else {
            echo $translation[$messageKey][$config->mainLanguage];
        }
    }
}
