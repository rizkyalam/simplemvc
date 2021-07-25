<?php 

namespace Core;

class ModelFactory
{
    static public function model($name)
    {
        $class = '\App\Models\\'.$name;
        return new $class;
    }
}