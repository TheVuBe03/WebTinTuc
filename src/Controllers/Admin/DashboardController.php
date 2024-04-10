<?php

namespace PC\Mvcoop\Controllers\Admin;

use Pc\Mvcoop\Commons\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->renderViewAdmin('dashboard');
    }
}
