<?php

namespace App\Https\Controllers;

use Lib\Foxy\Core\Base\Controller;

class __controllerController extends Controller
{
    public function someFunction()
    {
        render("something", [
            "foo" => "var"
        ]);
    }
}
