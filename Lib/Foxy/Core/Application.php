<?php

namespace Lib\Foxy\Core;

use Lib\Foxy\Core\Session;

class Application
{
    public function __construct()
    {
        Session::start();
    }

    public function handle()
    {
        $url = Request::getUrl();
        $route = Route::getRouteFromUrl($url);

        if (!$route)
            redirect()->route("error", ["msg" => "page-not-found"])->send();

        call_user_func_array([new $route["controller"], $route["method"]], $route["param"]);
    }

    public function terminate()
    {
        Database::closeConnection();
    }
}
