<?php

class Feed_Github extends Feed
{
    protected $credentials;
    protected $items;
    protected $apiURL = 'https://api.github.com';

    public function setUser($user)
    {
        $this->credentials['user'] = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->credentials['user'];
    }

    public function getPublicRepositories()
    {
        if ( !isset($this->credentials['user'])) {
            return array();
        }

        $url = $this->apiURL.'/users/'.$this->credentials['user'].'/repos?type?public&sort=updated&type=owner';
        $objects = array_filter($this->get($url), function ($item) {
            return ( ! $item->fork);
        });

        $repositories = array();
        foreach ($objects as $repository) {
            $temp = array();
            $temp['name'] = $repository->name;
            $temp['link'] = $repository->html_url;
            $temp['description'] = $repository->description;
            $created = $this->cleanDate($repository->created_at);
            $updated = $this->cleanDate($repository->updated_at);
            $pushed = $this->cleanDate($repository->pushed_at);
            $temp['date'] = max($created, $updated, $pushed);
            $temp['icon'] = 'fontawesome-github';

            $repositories[] = $temp;
        }
        return $repositories;
    }

    public function getPublicGists()
    {
        if ( !isset($this->credentials['user'])) {
            return array();
        }

        $url = $this->apiURL.'/users/'.$this->credentials['user'].'/gists?type?public&sort=updated&type=owner';
        $objects = $this->get($url);

        $gists = array();
        foreach ($objects as $gist) {
            $temp = array();
            $temp['name'] = 'Gist: ' . $gist->id;
            $temp['link'] = $gist->html_url;
            $temp['description'] = $gist->description;
            $created = $this->cleanDate($gist->created_at);
            $updated = $this->cleanDate($gist->updated_at);
            $temp['date'] = max($created, $updated);
            $temp['icon'] = 'entypo-code';

            $gists[] = $temp;
        }
        return $gists;
    }

    protected function cleanDate($date)
    {
        $date = str_replace(array('T', 'Z'), array(' ', ''), $date);
        return $date;
    }
}
