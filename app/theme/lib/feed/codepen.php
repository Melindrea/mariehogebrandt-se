<?php

class Feed_Codepen extends Feed
{
    protected $credentials;
    protected $items;
    protected $apiURL = 'http://codepen-awesomepi.timpietrusky.com';

    public function setUser($user)
    {
        $this->credentials['user'] = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->credentials['user'];
    }

     public function getPublicPens()
    {
        if ( !isset($this->credentials['user'])) {
            return array();
        }

        $url = $this->apiURL.'/'.$this->credentials['user'];
        $objects = Feed::get($url);

        if ($objects->status->message !== 'ok') {
            return array();
        }
        $objects = $objects->content->pens;

        $pens = array();
        foreach ($objects as $pen) {
            $temp = array();
            $temp['name'] = $pen->title;
            $temp['link'] = $pen->url->pen;
            $temp['description'] = $pen->description;

            $penDetails = Feed::get($url.'/pen/'.$pen->hash);
            $penDetails = $penDetails->content->pen;
            $created = strtotime($penDetails->created_at);
            $updated = strtotime($penDetails->updated_at);
            $temp['date'] = date('Y-m-h H:i:s', max($created, $updated));
            $temp['icon'] = 'entypo-code';

            $pens[] = $temp;
        }
        return $pens;
    }
}
