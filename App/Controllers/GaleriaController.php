<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\Lib\Foxy\Core\Controller;

class GaleriaController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return self::render("web.galeria");
    }
}
