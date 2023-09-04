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
        $dir = "img/gallery/";
        $filePath = $dir . $_FILES["image"]["name"];

        $galery = new Galeria(); 
        $galery->gale_name = substr($_FILES["image"]["name"], 0, -strlen((pathinfo($_FILES["image"]["name"], FILEINFO_EXTENSION))));
        $galery->gale_path = $filePath;

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], "Public/$filePath")) {
            redirect()
                ->route("dash.galery")
                ->error("Formato de imagen no valido.")
                ->send();
        }

        if (!Galeria::insert($galery)) {
            unlink("Public/$filePath");
            redirect()
                ->route("dash.galery")
                ->error("Formato de imagen no valido.")
                ->send();
        }

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