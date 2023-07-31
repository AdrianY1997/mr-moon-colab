<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Event;
use FoxyMVC\Lib\Foxy\Core\Controller;

class EventosController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    function index() {
        return self::render("web.eventos", [
            "events" => Event::get()
        ]);
    }
    function despliegue($id){
        return self::render("web.eventos.despliegue", [
            "events" => Event::get()
        ]);
    }
}
