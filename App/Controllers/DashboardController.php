<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Event;
use FoxyMVC\App\Models\Galeria;
use FoxyMVC\App\Models\Product;
use FoxyMVC\App\Models\Provider;
use FoxyMVC\App\Models\Reservation;
use FoxyMVC\App\Models\User;
use FoxyMVC\App\Models\Webdata;
use FoxyMVC\App\Packages\Privileges;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Response;
use FoxyMVC\Lib\Foxy\Database\Model;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();
        if (!Session::checkSession() || (Privileges::Admin->get() & Session::data("user_privileges") != Privileges::Admin->get())) {
            redirect()
                ->route("error", ["msg" => "missing-permissions"])
                ->send();
        }
    }

    public function index() {
        redirect()
            ->route("dash.home")
            ->send();
    }

    public function inicio() {
        return self::render("dashboard.home", [
            "active" => "home"
        ]);
    }

    public function info() {
        return self::render("dashboard.info", [
            "active" => "info",
        ]);
    }

    public function usuarios() {
        return self::render("dashboard.users", [
            "active" => "usuarios",
            "usuarios" => User::get(),
        ]);
    }

    public function proveedores() {
        return self::render("dashboard.prov", [
            "active" => "proveedores",
            "providers" => Provider::get()
        ]);
    }

    public function inventario() {
        return self::render("dashboard.inv", [
            "active" => "inventario",
            "products" => Product::getAllData(),
        ]);
    }

    public function facturas() {
        return self::render("dashboard.fact", [
            "active" => "facturas"
        ]);
    }

    public function menu() {
        return self::render("dashboard.menu", [
            "active" => "menu"
        ]);
    }

    public function reservas() {
        return self::render("dashboard.reservas", [
            "active" => "reservas",
        ]);
    }

    public function eventos() {
        return self::render("dashboard.eventos", [
            "active" => "eventos",
            "evento" => Event::get()


            
        ]);
    }

    public function galeria() {
        return self::render("dashboard.galeria", [
            "active" => "galeria",
            "photos" => Galeria::select("gale_id", "gale_path")->get(),
        ]);
    }



    public function updateWebInfo() {
        $data = Request::getData();
        $dir = "img/static/";
        $filePath = $dir . $_FILES["image"]["name"];
        $data = Request::getData();

        $webdata = new Webdata();

        if (!password_verify($data["password"], Session::data("user_pass"))) {
            redirect()
                ->route("dash.info")
                ->error("No se pudo actualizar, por que la contraseña no coincide con tu usuario")
                ->send();
        }
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], "Public/$filePath")) {
            redirect()
                ->route("dash.info")
                ->error("Formato de imagen no valido.")
                ->send();
        }
        $webdata=[
        "webd_name" => $data["name"],
        "webd_subt" => $data["subt"],
        "webd_logo"=>$filePath,
        "webd_email" => $data["email"],
        "webd_phone" => $data["phone"],
        "webd_address" => $data["address"],
        "webd_city" => $data["city"],
        "webd_fblink" => $data["fblink"],
        "webd_twlink" => $data["twlink"],
        "webd_iglink" => $data["iglink"],
        "webd_ytlink" => $data["ytlink"],
        "webd_m" => $data["mision"],
        "webd_v" => $data["vision"],
        ];
       
        Webdata::update($webdata);


        if (!$webdata) {
            redirect()
                ->route("dash.info")
                ->error("Hubo un error al actualizar la información de la pagina.")
                ->send();
        }

        redirect()
            ->route("dash.info")
            ->success("Se ha actualizado la información de la pagina correctamente.")
            ->send();
    }

    public function getUserInfo($id) {
        $user = User::where("user_id", $id)->first();
        if (!$user) {
            Response::status(401)->end("Ha ocurrido un error al obtener la información del perfil.");
        }
        Response::json([
            "message" => "Se ha cargado la información",
            "user" => $user
        ]);
    }

    public function setUserInfo() {
        $data = Request::getFormData();
        $isUpdated = User::where("user_id", $data->id)->update([
            "user_nick" => $data->nick,
            "user_name" => $data->name,
            "user_lastname" => $data->lastname,
            "user_email" => $data->email,
            "user_address" => $data->address,
            "user_phone" => $data->phone,
        ]);

        if (!$isUpdated) {
            Response::status(500)->end("Error al actualizar la información ");
        }
        Response::end("Se ha actualizado la información ");
    }

    public function getItem($id) {
        $products = Product::getAllData($id);

        if ($products === false) {
            Response::status(500)->end("Hubo un error al obtener los datos");
        }

        Response::json(["product" => $products[0]]);
    }

    public function getProv() {
        Response::checkMethod("GET");

        $providers = Provider::get();
        if ($providers === false) {
            Response::status(500)->json(["providers" => $providers, "message" => "No se ha podido cargar la información "]);
        }

        Response::status(200)->json(["providers" => $providers]);
    }



    public function setMenuImg($id) {
        if (!isset($_FILES["menu-img"])) {
            redirect()->route("dash.menu")->error("No se ha seleccionado una image")->send();
        }

        $menus = [
            "1" => "menu-bebidas",
            "2" => "menu-principal",
            "3" => "menu-comidas",
        ];

        $targetDir = "Public/img/menu/";
        $imageFileType = strtolower(pathinfo(basename($_FILES["menu-img"]["name"]), PATHINFO_EXTENSION));
        $targetFile = $targetDir . $menus[$id] . "." . $imageFileType;

        if (getimagesize($_FILES["menu-img"]["tmp_name"]) === false) {
            redirect()
                ->route("dash.menu")
                ->error("Se ha seleccionado una imagen invalida")
                ->send();
        }

        if ($_FILES["menu-img"]["size"] > 500000) {
            redirect()
                ->route("dash.menu")
                ->error("El tamaño de la imagen debe ser menor a 500kb")
                ->send();
        }

        if ($imageFileType != "jpg" && $imageFileType != "png") {
            redirect()
                ->route("dash.menu")
                ->error("Solo se aceptan imágenes de tipo jpg y png")
                ->send();
        }

        if (!move_uploaded_file($_FILES["menu-img"]["tmp_name"], $targetFile)) {
            redirect()
                ->route("dash.menu")
                ->error("No se ha podido subir la imagen")
                ->send();
        }

        redirect()
            ->route("dash.menu")
            ->success("Se ha guardado la imagen con éxito")
            ->send();
    }
}