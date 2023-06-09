<?php

// *****************************************
// *****************************************
//          Helper functions for pages
// *****************************************
// *****************************************


class pagesManager
{

    public function getPages()
    {

        require_once(PATH . '/handle/page.php');

        $pages = [];

        $pages[] = new page('/', 'home', PATH . '/pages/home.html', false);
        $pages[] = new page('/admin', 'Admin Login', PATH . '/pages/admin.php', PATH . '/layouts/layout.php');
        $pages[] = new page('/test', 'Test', PATH . '/pages/.php', false);

        return $pages;
    }

    public function findPageByUri($uri)
    {
        $pages = $this->getPages();

        foreach ($pages as $page) {
            if ($page->getUri() == $uri) {
                return $page;
            }
        }
        return null;
    }

    public function getView($uri)
    {

        require_once(PATH . '/handle/renderManager.php');
        $renderManager = renderManager::getInstance();

        $page = $this->findPageByUri($uri);

        $contentPath = $page->getContentPath();
        $layoutPath = $page->getLayoutPath();

        $contentInLayout = $renderManager->putContentInLayout($contentPath, $layoutPath);

        $contentInLayout = $renderManager->replaceCodeInBrackets($contentInLayout);

        return $contentInLayout;
    }

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new pagesManager();
        }
        return self::$instance;
    }
}
