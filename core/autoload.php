<?php 
spl_autoload_register(function($class) {
    $new_class = namespace_to_path($class);

    if (file_exists($new_class . '.php')) {
        require_once $new_class.'.php';
    }
});

function namespace_to_path($class) {
    $split_class = explode('\\', $class);
    $total = count($split_class) - 1;
    $new_class = [];

    foreach ($split_class as $key => $val) {
        $new_class[] = $key !== $total ? strtolower($val) : $val;
    }

    $join_class = implode('/', $new_class);

    return $join_class;
}
