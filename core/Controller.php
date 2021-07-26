<?php 

namespace Core;

abstract class Controller
{
    /**
     * Display data to browser from views.
     * 
     * @param string $file_path Path of file from folder app/view.
     * @param array $data The data that should be display.
     */
    protected function view($file_path, $data = [])
    {
        extract($data);

        require_once 'app/views/' . $file_path . '.php';
    }
}
