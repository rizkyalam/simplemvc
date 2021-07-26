<?php 

/*
 * A functions to call a class automatically.
 */
spl_autoload_register(function($class) {
    $new_class = namespace_to_path($class);

    if (file_exists($new_class . '.php')) {
        require_once $new_class.'.php';
    }
});
