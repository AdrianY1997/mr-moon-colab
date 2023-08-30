<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Galeria;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;

class GaleriaController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return self::render("web.galeria",  [
            "galerias" => Galeria::get(),
        ]);
    }
    public function add() {
        $data = Request::getData();

        $galery = new Galeria();

        $galery->gale_id = $data["item-nit"];
        $galery->gale_name = $data["item-name"];
        $galery->gale_path = $data["item-email"];

        $galeryId = Galeria::insert($galery);

        redirect()
            ->route("dash.galery")
            ->success("Se ha añadido una imaen nueva.")
            ->send();
    }
    public function delete($id) {
        // Galeria::where("gale_id", $id)->delete();
        redirect()->route("dash.galery")->warning("Esta funcionalidad no se ha implementado aun.")->send();
    }
}
