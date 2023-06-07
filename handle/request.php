<?php

class request
{
    public $domain;
    public $uri;

    public function __construct()
    {
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->uri_noslash = substr($this->uri, 1);
    }
}
