<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Event;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Response;

class EventosController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    function index() {
        return self::render("web.eventos", [
            "events" => Event::get()
        ]);
    }

    function get($id){
        Response::checkMethod("GET");

        if (!$id) {
            Response::status(401)->end("El identificador del evento ha sido modificado manualmente, por favor recargue la pagina y vuelva a intentarlo");
        }

        if (!$event = Event::where("even_id", $id)->first()) {
            Response::status(401)->end("El identificado parece no ser el correcto, recargue la pagina e inténtelo nuevamente");
        }

        Response::json([$event]);
    }
}
