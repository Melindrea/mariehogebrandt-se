<?php
if( !class_exists( 'WP_Http' ) )
    include_once( ABSPATH . WPINC. '/class-http.php' );

require( get_template_directory() . '/lib/feed/github.php' );
require( get_template_directory() . '/lib/feed/codepen.php' );
require( get_template_directory() . '/lib/feed/deviantart.php' );
abstract class Feed
{
    const OBJECTS = 0;
    const JSON = 1;

    public abstract function setUser($user);
    public abstract function getUser();

    public static function factory($feed)
    {
        $class = 'Feed_'.$feed;
        return new $class;
    }

    // JSON-api
    public function get($url, $returnType = self::OBJECTS)
    {
        $request = new WP_Http;
        $result = $request->request($url);

        $return = array();

        if (is_wp_error($result)) {
            $response = 500;
        } else {
            $response = $result['response']['code'];
        }
        if ($response !== 200) {
            switch ($returnType) {
                case self::JSON:
                    $return = '{}';
                    break;

                case self::OBJECTS:
                default:
                    return array();
                    break;
            }
        }
        $body = $result['body'];
        switch ($returnType) {
            case self::JSON:
                $return = $body;
                break;

            case self::OBJECTS:
            default:
                $return = json_decode($body);
                break;
        }

        return $return;
    }

    public function getRSS($url)
    {
        $doc = new DOMDocument();
        $doc->load($url);

        return $doc;
    }
    public static function sort($a, $b)
    {
        $aDate = strtotime($a['date']);
        $bDate = strtotime($b['date']);
        if ($aDate === $bDate) {
            return 0;
        }

        return ($aDate < $bDate) ? 1 : -1;
    }
}
