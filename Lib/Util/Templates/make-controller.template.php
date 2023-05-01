<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Base\Controller;

class __controllerController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function someFunction() {
        render("something", [
            "foo" => "var"
        ]);
    }
}
