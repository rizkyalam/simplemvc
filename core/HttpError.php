<?php 

namespace Core;

/**
 * Here is for setting up and access 
 * the display or message from the error of http
 */
class HttpError
{
    /**
     * Display for client error which
     * the page is not found
     */
    public static function notFound()
    {
        http_response_code(404);

        $render_path_404 = 'app/views/404.php';

        if (file_exists($render_path_404)) {
            require_once $render_path_404;
        } else {
            echo '<h1>404 Not Found</h1>';
        }
    }
}
