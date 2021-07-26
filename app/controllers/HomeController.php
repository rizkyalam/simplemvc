<?php 

namespace App\Controllers;

use Core\Controller;

/**
 * Example Homepage Controller
 */
class HomeController extends Controller
{
    /**
     * Display method for static route
     */
    public function index()
    {
        $this->view('home');
    }

    /**
     * Display method for dynamic route
     * 
     * @param $bar
     */
    public function foo($bar)
    {
        $data['bar'] = $bar;

        $this->view('dynamic', $data);
    }
}
