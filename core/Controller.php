<?php 

namespace Core;

abstract class Controller
{
    protected function view($file_path, $data = [])
    {
        extract($data);

        require_once 'app/views/' . $file_path . '.php';
    }
}
