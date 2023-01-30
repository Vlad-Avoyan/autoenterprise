<?php

namespace App\Services;

class Router
{

    private static array $list = [];


    /**
     * the method registers the rout for a normal page
     * @param $uri
     * @param $page_name
     * @return void
     */

    public static function page($uri, $page_name)
    {

        self::$list[] = [
            "uri" => $uri,
            "page" => $page_name
        ];
    }

    /**
     * method for opening pages after registration
     * @return void
     */

    public static function enable()
    {
        $query = $_GET['q'];
        foreach (self::$list as $route) {
            if ($route['uri'] === '/' . $query) {
                require_once "views/pages/" . $route['page'] . ".php";
                die();
            }
        }
        self::not_found_page();
    }

    /**
     * method to generate error for unregistered rout
     * @return void
     */

    private static function not_found_page()
    {
        require_once "views/errors/404.php";
    }

}