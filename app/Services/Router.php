<?php

namespace App\Services;

class Router
{

    /**
     * the method registers the rout for a normal page
     * @param $uri
     * @param $page_name
     * @return void
     */

    private static array $list = [];

    /**
     * method for opening pages after registration
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
     * method vor POST requests
     * @param $uri
     * @param $class
     * @param $method
     * @return void
     */

    public static function post($uri, $class, $method)
    {
        self::$list[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "post" => true,
        ];
    }


    /**
     * method for filter get method and post method
     * @return void
     */

    public static function enable()
    {
        $query = $_GET['q'];

        foreach (self::$list as $route) {
            if ($route['uri'] === '/' . $query) {
                if ($route['post'] === true && $_SERVER["REQUEST_METHOD"] === "POST") {
                    $action = new $route["class"];
                    $method = $route["method"];
                    $action->$method();
                    die();
                } else {
                    require_once "views/pages/" . $route['page'] . ".php";
                    die();
                }
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