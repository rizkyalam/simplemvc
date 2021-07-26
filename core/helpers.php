<?php 

/**
 * Change the namespace to be a path file.
 * 
 * @param $class
 * @return $join_class
 */
function namespace_to_path ($class) {
    $split_class = explode('\\', $class);
    $total = count($split_class) - 1;
    $split_new_class = [];

    foreach ($split_class as $key => $val) {
        $split_new_class[] = $key !== $total ? strtolower($val) : $val;
    }

    $join_class = implode('/', $split_new_class);

    return $join_class;
}

/**
 * Setup the environment.
 */
function create_env() {
    $env_file = file_get_contents('.env');

    $env_split = preg_split('/\n/', $env_file);

    foreach ($env_split as $env) {
        if (!empty($env)) {
            putenv($env);
        }
    }
}

/**
 * Base url of this application
 * 
 * @param $url
 */
function base_url($url = '/') {
    $base_url = trim(getenv('BASE_URL'), '/');
    echo $base_url . $url;
}

/**
 * Accessing the public directory
 * 
 * @param $file_path
 */
function public_asset($file_path) {
    $base_url = trim(getenv('BASE_URL'), '/');
    echo $base_url . '/public/'.$file_path;
}
