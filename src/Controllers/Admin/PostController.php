<?php

namespace Pc\Mvcoop\Controllers\Admin;

use Pc\Mvcoop\Commons\Controller;
use Pc\Mvcoop\Models\Categories;
use Pc\Mvcoop\Models\Post;

class PostController extends Controller
{

    private Post $post;
    private string $folder = 'posts.';

    const PATH_UPLOAD = '/uploads/post/';

    public function __construct()
    {
        $this->post = new Post;
    }
    public function index()
    {
        $data['posts'] = $this->post->getAll();

        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            $data
        );
    }

    public function create()
    {
        $data['category'] = (new Categories)->getAll();
        if (!empty($_POST)) {

            $category_id = $_POST['category_id'];
            $title = $_POST['title'];
            $excerpt = $_POST['excerpt'];
            $content = $_POST['content'];
            $image = $_FILES['image'] ?? null;
            $avatarPath = null;
            if (!empty($image)) {

                $avatarPath = self::PATH_UPLOAD . $image['name'];

                if (!move_uploaded_file($image['tmp_name'], PATH_ROOT . $avatarPath))
                    $avatarPath = null;
            }

            $this->post->insert($category_id, $title, $excerpt, $content, $avatarPath);
            header('location: /admin/posts');
            exit();
        }
        return $this->renderViewAdmin($this->folder . __FUNCTION__, $data);
    }


    //Xem chi tiết
    public function show($id)
    {

        $data['post'] = $this->post->getById($id);
        if (empty($data['post'])) {
            die(404);
        }

        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            $data
        );
    }

    public function update($id)
    {
        $data['post'] = $this->post->getByID($id);

        if (empty($data['post'])) {
            die(404);
        }

        if (!empty($_POST)) {
            $categoryID = $_POST['category_id'];
            $title = $_POST['title'];
            $excerpt = $_POST['excerpt'];
            $content = $_POST['content'];

            $image = $_FILES['image'] ?? null;
            $imagePath = $data['post']['p_image'];
            $move = false;
            if ($image) {
                $imagePath = self::PATH_UPLOAD . time() . $image['name'];

                if (!move_uploaded_file($image['tmp_name'], PATH_ROOT . $imagePath)) {
                    $imagePath = $data['post']['p_image'];
                } else {
                    $move = true;
                }
            }

            $this->post->update(
                $id,
                $categoryID,
                $title,
                $content,
                $excerpt,
                $imagePath
            );

            if (
                $move
                && $data['post']['p_image']
                && file_exists(PATH_ROOT . $data['post']['p_image'])
            ) {
                unlink(PATH_ROOT . $data['post']['p_image']);
            }

            $_SESSION['success'] = 'Thao tác thành công!';

            header("Location: /admin/posts/$id/update");
            exit();
        }

        $data['categories'] = (new Categories)->getAll();

        return $this->renderViewAdmin(
            $this->folder . __FUNCTION__,
            $data
        );
    }


    public function delete($id)
    {
        $this->post->deleteById($id);
        header('location: /admin/posts');
         
        if (empty($post)) {
            die(404);
        }
        if ( $post['image'] && file_exists(PATH_ROOT . $post['image'])) {
            unlink(PATH_ROOT . $post['image']);
        }
        
    }
}
