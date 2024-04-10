<?php

namespace Pc\Mvcoop\Controllers\Admin;

use Pc\Mvcoop\Commons\Controller;
use Pc\Mvcoop\Models\User;

class UserController extends Controller
{

    private User $user;
    private string $folder = 'users.';

    const PATH_UPLOAD = '/uploads/user/';

    public function __construct()
    {
        $this->user = new User;
    }
    public function index()
    {
        $data['users'] = $this->user->getAll();

        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            $data
        );
    }

    public function create()
    {
        if (!empty($_POST)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $img = $_FILES['img'] ?? null;
            $avatarPath = null;

            if(!empty($img)){
                
                $avatarPath= self::PATH_UPLOAD . $img['name'];

                if(!move_uploaded_file($img['tmp_name'],PATH_ROOT . $avatarPath))
                $avatarPath = null ;
            }

            $this->user->insert($name, $email, $password, $avatarPath);
            header('location: /admin/users');
            exit();
        }
        return $this->renderViewAdmin($this->folder . __FUNCTION__);
    }

    //Xem chi tiết
    public function show($id)
    {
        $data['user'] = $this->user->getById($id);
        if (empty($data['user'])) {
            die(404);
        }
        
        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            $data
        );
    }

    public function update($id)
    {
        $user = $this->user->getById($id);
        if (empty($user)) {
            die(404);
        }
        if(!empty($_POST)){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $img = $_FILES['img'] ?? null;
            $avatarPath = $user['img'];

            if(!empty($img)){
                
                $avatarPath= self::PATH_UPLOAD . $img['name'];

                if(!move_uploaded_file($img['tmp_name'],PATH_ROOT . $avatarPath)){
                $avatarPath = $user['img'];
            }
            }
            $this->user->update($id, $name, $email, $password, $avatarPath);
            $_SESSION['success']="Thao tác thành công";
            header("location: /admin/users/{$id}/update");
            exit();
        }
        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__, ['user'=>$user]);
    }

    public function delete($id)
    {
        $this->user->deleteById($id);
        header('location: /admin/users');
    }
}
