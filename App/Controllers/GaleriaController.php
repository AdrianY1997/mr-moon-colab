<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Galeria;
use FoxyMVC\Lib\Foxy\Core\Controller;

class GaleriaController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return self::render("web.galeria",  [
            "galerias" => Galeria::get()
        ]);
    }
}
