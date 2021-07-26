<?php 

namespace Core;

class ModelFactory
{
    /**
     * Accessing a model in controller.
     * 
     * @param $name The name of model should be case sensitive.
     */
    static public function model($name)
    {
        $class = '\App\Models\\'.$name;
        return new $class;
    }
}
