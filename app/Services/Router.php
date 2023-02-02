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

    public static function post($uri, $class, $method, $form_data = false, $files = false)
    {
        self::$list[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "post" => true,
            "formdata" => $form_data,
            "files" => $files
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
                    if ($route['formdata'] && $route['files']) {
                        $action->$method($_POST, $_FILES);
                    } elseif ($route['formdata'] && !$route['files']) {
                        $action->$method($_POST);
                    } else {
                        $action->$method($_POST);
                    }
                    die();
                } else {
                    require_once "views/pages/" . $route['page'] . ".php";
                    die();
                }
            }
        }
        self::error('404');
    }

    /**
     * method to generate error for unregistered rout
     * @return void
     */

    public static function error($error)
    {
        require_once "views/errors/" . $error . ".php";
    }

    public static function redirect($page)
    {
        require_once "views/pages/" . $page . ".php";
        die();
    }
}