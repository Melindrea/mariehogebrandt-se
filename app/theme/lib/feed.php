<?php
require( get_template_directory() . '/lib/feed/github.php' );
class Feed
{
    public function factory($feed)
    {
        $class = 'Feed_'.$feed;
        return new $class;
    }
}
