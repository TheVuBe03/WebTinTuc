<?php

namespace Pc\Mvcoop\Controllers\Admin;

use Pc\Mvcoop\Commons\Controller;
use Pc\Mvcoop\Models\User;

class AuthenticateController extends Controller
{
    public function login()
    {
        if (!empty($_POST)) {
            $_SESSION['errors'] = [];

            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['errors']['email'] = 'Email khong duoc de trong va dung dinh dang';
            }
            if (empty($password) ) {
                $_SESSION['errors']['password'] = 'Password khong duoc de trong';
            }

            $user = (new User)->getByEmailAndPassword($_POST['email'], $_POST['password']);  

            if (empty($user)) {
                $_SESSION['errors']['not-found'] = 'Khong tim thay nguoi dung';
            }else{
                $_SESSION['user'] = $user;

                header('Location: /admin/');
                exit();
            }
        }
        return $this->renderViewAdmin(__FUNCTION__);
    }

    public function logout(){
        session_destroy ();
        header('Location: /');
        exit();
    }
}
