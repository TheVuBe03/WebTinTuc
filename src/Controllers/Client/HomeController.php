<?php

namespace Pc\Mvcoop\Controllers\Client;

use Pc\Mvcoop\Commons\Controller;
use Pc\Mvcoop\Models\Post;

class HomeController extends Controller
{

    private Post $post;

    public function __construct(){

        $this->post = new Post();
    }
    public function index()
    {

        $postFistLatest = $this->post->getFistLatest();
        $postTop6 = $this->post->getTop6();
        $postTop6Chunk =array_chunk($postTop6, 3);

        return $this->renderViewClient('home',
            [
            'postFistLatest'=> $postFistLatest,
            'postTop6Chunk'=> $postTop6Chunk

            ]
    );
    }
}
