<?php 

namespace App\Controllers;

use Core\Controller;
use Core\ModelFactory;

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

    public function user()
    {
        $data = [
            'username' => 'test1',
            'password' => password_hash('test', PASSWORD_BCRYPT),
        ];

        // ModelFactory::model('User')->create($data);
        // ModelFactory::model('User')->update($data, 2);
        // $user = ModelFactory::model('User')->get(['username', 'password'], ['user_id' => 1]);
        // var_dump($user);
        // ModelFactory::model('User')->delete(3);
    }
}
