<?php

namespace Pc\Mvcoop\Controllers\Admin;

use Pc\Mvcoop\Commons\Controller;
use Pc\Mvcoop\Models\Categories;

class CategoryController extends Controller{
    private Categories $category;
    private string $folder = 'categories.';

    public function __construct()
    {
        $this->category = new Categories;
    }

    public function index()
    {
        $data['categories'] = $this->category->getAll();

        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            $data
        );
    }
    public function create()
    {
        if (!empty($_POST)) {
            $this->category->insert($_POST['name']);
            header('location: /admin/categories');
        }
        return $this->renderViewAdmin($this->folder . __FUNCTION__);
    }
    public function delete($id)
    {
        $this->category->deleteById($id);
        header('location: /admin/categories');
    }
    public function show($id)
    {
        $data['cat'] = $this->category->getById($id);
        if (empty($data['cat'])) {
            die(404);
        }
        
        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            $data
        );
    }
    public function update($id)
    {
        $data['cat'] = $this->category->getById($id);
        if (empty($data['cat'])) {
            die(404);
        }
        if(!empty($_POST)){
            $this->category->update(
                $id,
                $_POST['name'] );
            $_SESSION['success']="Thao tác thành công";
            header("location: /admin/categories/{$id}/update");
            exit();
        }
        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,$data);
    }


} 