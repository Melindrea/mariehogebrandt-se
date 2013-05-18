<?php
class GlobalActivityWidget
{
    protected $data;
    public function __construct()
    {
        //Mockup!
        $this->data = array(
            array(
                'icon' => 'entypo-link',
                'url' => '#',
                'name' => 'Link',
                'description' => 'Description of link',
            ),
            array(
                'icon' => 'entypo-post',
                'url' => '#',
                'name' => 'WP Post',
                'description' => 'Description of post',
            ),
            array(
                'icon' => 'entypo-code',
                'url' => '#',
                'name' => 'Gist/Codepen',
                'description' => 'Description of code',
            ),
            array(
                'icon' => 'fontawesome-github',
                'url' => '#',
                'name' => 'Repository',
                'description' => 'Description of repository',
            ),
        );

    }

    public function render()
    {
        $view = View::factory('global-activity-list')
        ->bind('items', $this->data)
        ->render();
    }
}
