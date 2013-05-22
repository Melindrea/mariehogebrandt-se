<?php

class Feed_DeviantArt extends Feed
{
    protected $credentials;
    protected $items;
    protected $apiURL = 'http://backend.deviantart.com/rss.xml';
    protected $oEmbedUrl = 'http://backend.deviantart.com/oembed?url=';

    public function setUser($user)
    {
        $this->credentials['user'] = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->credentials['user'];
    }

    public function getDeviations()
    {
        if ( !isset($this->credentials['user'])) {
            return array();
        }

        $url = $this->apiURL.'?type=deviation&q=by%3A'.$this->credentials['user'].'+sort%3Atime+meta%3Aall';
        $doc = $this->getRSS($url);

        $deviations = array();
        foreach ($doc->getElementsByTagName('item') as $node) {

            $link = $node->getElementsByTagName('link')->item(0)->nodeValue;
            $pattern = '/\/art/i';

            if (preg_match($pattern, $link)) {
                $temp = array();
                $temp['name'] = $node->getElementsByTagName('title')->item(0)->nodeValue;
                $temp['link'] = $link;
                $category = $node->getElementsByTagName('category')->item(0)->nodeValue;
                $temp['description'] = 'Category: '.$category;
                $temp['date'] = $this->cleanDate($node->getElementsByTagName('pubDate')
                    ->item(0)->nodeValue);
                $temp['icon'] = 'brandico-deviantart';

                $deviations[] = $temp;
            }
        }
        return $deviations;
    }

    public function getDeviation($link)
    {
        return $this->get($this->oEmbedUrl.$link);
    }
    protected function cleanDate($date)
    {
        $date = date('Y-m-d H:i:s', strtotime($date));
        return $date;
    }
}
