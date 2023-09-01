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

 
        $galery->gale_name = "Galeria";
        $galery->gale_path = "img/gallery/".$data["img"];

        $galeryId = Galeria::insert($galery);

        redirect()
            ->route("dash.galery")
            ->success("Se ha añadido una imagen nueva.")
            ->send();
    }
    public function delete($id) {
        Galeria::where("gale_id", $id)->delete();
        redirect()->route("dash.galery")->warning("La imagen se a eliminado con Exito.")->send();
    }
}
