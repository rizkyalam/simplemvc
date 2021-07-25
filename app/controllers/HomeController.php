<?php 

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->view('home');
    }

    public function getId($id, $test)
    {
        echo "Get ID from $id and $test";
    }

    public function test()
    {
        echo 'test';
    }
}
