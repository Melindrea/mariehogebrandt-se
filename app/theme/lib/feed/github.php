<?php

class Feed_Github extends Feed
{
    protected $credentials;
    protected $items;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function fetch($numberOfItems = 10)
    {

    }
}
