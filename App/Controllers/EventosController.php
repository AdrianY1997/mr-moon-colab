<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Event;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
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
    public function add() {
        $data = Request::getData();
    
        $even = new Event();
    
        $even->even_name = $data["item-name"];
        $even->even_text = $data["item-text"];
        $even->even_fech = $data["item-fech"];
        $even->even_path = "img/eventos/" . $data["item-path"];
    
        $evenId = Event::insert($even);
    
        return redirect()
            ->route("dash.even")
            ->success("Se ha añadido un evento nuevo.")
            ->send();
    }
    
    public function edit($id) {
        $data = Request::getData();
    
        $even = [
            "even_name" => $data["even-edit-name"],
            "even_text" => $data["even-edit-text"],
            "even_fech" => $data["even-edit-fech"],
            "even_path" => "img/eventos/" . $data["even-edit-path"],
            
        ];
    
        Event::where("even_id", $data["even-edit-id"])->update($even);
    
        return redirect()
            ->route("dash.even")
            ->success("Se ha actualizado el evento.")
            ->send();
    }
    
    
    public function delete($id) {
        Event::where("even_id", $id)->delete();
    
        return redirect()
            ->route("dash.even")
            ->warning("Se Elimino el Evento.")
            ->send();
    }
    
    
}
