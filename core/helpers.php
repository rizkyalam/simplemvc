<?php 

function namespace_to_path ($class) {
    $split_class = explode('\\', $class);
    $total = count($split_class) - 1;
    $new_class = [];

    foreach ($split_class as $key => $val) {
        $new_class[] = $key !== $total ? strtolower($val) : $val;
    }

    $join_class = implode('/', $new_class);

    return $join_class;
}

function public_asset($file_path) {
    echo 'public/'.$file_path;
}

function create_env() {
    $env_file = file_get_contents('.env');

    $env_split = preg_split('/\n/', $env_file);

    foreach ($env_split as $env) {
        if (!empty($env)) {
            putenv($env);
        }
    }
}