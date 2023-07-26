<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\Lib\Foxy\Core\Controller;

class __controllerController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function someFunction() {
        self::render("something", [
            "foo" => "var"
        ]);
    }
}
