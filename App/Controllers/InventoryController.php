<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Product;
use FoxyMVC\App\Models\ProductProvider;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;

class InventoryController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function add() {
        $data = Request::getData();

        $prod = new Product();
        $prod->prod_ref = $data["item-ref"];
        $prod->prod_name = $data["item-name"];
        $prod->prod_desc = $data["item-desc"];
        $prod->prod_stock = $data["item-stock"];
        $prod->prod_value = $data["item-value"];

        $prodId = Product::insert($prod);

        $pp = new ProductProvider();
        $pp->prod_id = $prodId;
        $pp->prov_id = $data["item-prov"];

        $ppId = ProductProvider::insert($pp);

        redirect()->route("dash.stock")->success("Se ha añadido un producto nuevo.")->send();
    }

    public function edit($id) {
        $data = Request::getData();

        $prod = [
            "prod_ref" => $data["item-edit-ref"],
            "prod_name" => $data["item-edit-name"],
            "prod_desc" => $data["item-edit-desc"],
            "prod_stock" => $data["item-edit-stock"],
            "prod_value" => $data["item-edit-value"],
        ];

        $pp = [
            "prod_id" => $data["item-edit-id"],
            "prov_id" => $data["item-edit-prov"]
        ];

        Product::where("prod_id", $data["item-edit-id"])->update($prod);
        ProductProvider::where("prod_id", $data["item-edit-id"])->where("prov_id", $data["item-edit-prov"])->update($pp);

        redirect()->route("dash.stock")->success("Se ha actualizado el producto.")->send();
    }

    public function delete($prod, $prov) {
        // ProductProvider::where("prod_id", $prod)->where("prov_id", $prov)->delete();
        // Product::where("prod_id", $prod)->delete();

        redirect()->route("dash.stock")->warning("Esta funcionalidad no se ha implementado aun.")->send();
    }
}
