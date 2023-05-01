<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Base\Controller;

class EventosController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    function index() {
        render("web.eventos");
    }
}
