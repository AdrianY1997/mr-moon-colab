<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Provider;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Response;

class ProviderController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function getProv($id) {

        $providers = Provider::first();
        if (!$providers) {
            Response::status(500)->end("No se ha podido cargar la información ");
        }

        Response::status(200)->json(["provider" => $providers]);
    }

    public function add() {
        $data = Request::getData();

        $prov = new Provider();

        $prov->prov_nit = $data["item-nit"];
        $prov->prov_name = $data["item-name"];
        $prov->prov_email = $data["item-email"];
        $prov->prov_phone = $data["item-phone"];

        $provId = Provider::insert($prov);

        redirect()
            ->route("dash.prov")
            ->success("Se ha añadido un proveedor nuevo.")
            ->send();
    }

    public function edit($id) {
        $data = Request::getData();

        $prov = [
            "prov_nit" => $data["prov-edit-nit"],
            "prov_name" => $data["prov-edit-name"],
            "prov_email" => $data["prov-edit-email"],
            "prov_phone" => $data["prov-edit-phone"],
        ];

        Provider::where("prov_id", $data["prov-edit-id"])->update($prov);

        redirect()
            ->route("dash.prov")
            ->success("Se ha actualizado el producto.")
            ->send();
    }

    public function delete($id) {
        // Provider::where("prov_id", $id)->delete();
        // ProductProvider::where("prov_id", $id)->delete();

        redirect()
            ->route("dash.prov")
            ->warning("Esta funcionalidad no se ha implementado aun.")
            ->send();
    }
}
