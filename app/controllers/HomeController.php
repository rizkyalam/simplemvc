<?php 

namespace App\Controllers;

class HomeController
{
    public function index()
    {
        echo 'halaman index';
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
