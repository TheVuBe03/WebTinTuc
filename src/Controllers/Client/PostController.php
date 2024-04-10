<?php

namespace Pc\Mvcoop\Controllers\Client;

use Pc\Mvcoop\Commons\Controller;
use Pc\Mvcoop\Models\Post;

class PostController extends Controller
{

    private Post $post;

    public function __construct()
    {

        $this->post = new Post();
    }
    public function show($id)
    {

        $post = $this->post->getById($id);

        return $this->renderViewClient(
            'post-show',
            [
                'post' => $post,

            ]
        );
    }
}
