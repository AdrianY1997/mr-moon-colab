<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Base\Controller;

class MenuController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        render("web.menu");
    }
}
