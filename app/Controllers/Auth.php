<?php

namespace App\Controllers;

use App\Services\Router;

class Auth
{
    /**
     * registration method with pic or without pic
     * @param $data
     * @param $files
     * @return void
     */


    public function register($data, $files)
    {

        $email = $data['email'];
        $username = $data['username'];
        $full_name = $data['full_name'];
        $password = $data['password'];
        $password_confirm = $data['password_confirm'];

        $avatar = $files['avatar'];

        $fileName = time() . '_' . $avatar["name"];
        $path = "uploads/avatars/ . $fileName";

        if (move_uploaded_file($avatar["tmp_name"], $path )) {
            $user = \R::dispense('users');
            $user->email = $email;
            $user->username = $username;
            $user->full_name = $full_name;
            $user->password = $password;
            $user->password_confirm = password_hash( $password_confirm, PASSWORD_DEFAULT);
            \R::store($user);
            Router::redirect('login');
        }else {
            Router::error('500');
        }

    }
}