<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\Lib\Foxy\Core\Controller;

class EventosController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    function index() {
        return self::render("web.eventos");
    }
}