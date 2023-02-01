<?php

namespace App\Services;

class App
{

    /**
     * start our app (Database)
     * @return void
     */

    public static function start()
    {
        self::libs();
        self::db();
    }

    /**
     * connect to library
     * @return void
     */
    public static function libs()
    {
        $config = require_once "config/app.php";

        foreach ($config["libs"] as $lib) {
            require_once "libs/" . $lib . ".php";
        }
    }

    /**
     * connect to database (RB)
     * @return void
     *
     */

    public static function db()
    {
        $config = require_once "config/db.php";


        if ($config['enable']) {
            \R::setup('mysql:host=' . $config['host'] . ';port=3306 dbname=' . $config['dbname'] . '',
                '' . $config['username'] . '', '' . $config['password'] . '');

            if (!\R::testConnection()) {
                die("Error database connect");
            }
        }
    }
}