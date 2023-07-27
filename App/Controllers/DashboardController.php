<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Product;
use FoxyMVC\App\Models\Provider;
use FoxyMVC\App\Models\Reservation;
use FoxyMVC\App\Models\Role;
use FoxyMVC\App\Models\User;
use FoxyMVC\App\Models\Webdata;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Controller;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();
        if (!Session::checkSession() || empty(Role::getUserRole(Session::data("user_id"), Role::ADMIN))) {
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

    public function updateWebInfo() {
        $data = Request::getData();

        $webdata = new Webdata();

        if (!password_verify($data["password"], Session::data("password"))) {
            redirect()
                ->route("dash.info")
                ->error("No se pudo actualizar, por que la contraseña no coincide con tu usuario")
                ->send();
        }

        $webdata->webd_name = $data["name"];
        $webdata->webd_subt = $data["subt"];
        $webdata->webd_email = $data["email"];
        $webdata->webd_phone = $data["phone"];
        $webdata->webd_address = $data["address"];
        $webdata->webd_city = $data["city"];
        $webdata->webd_fblink = $data["fblink"];
        $webdata->webd_twlink = $data["twlink"];
        $webdata->webd_iglink = $data["iglink"];
        $webdata->webd_ytlink = $data["ytlink"];

        if (!$webdata->model->update()) {
            redirect()
                ->route("dash.info")
                ->error("Ubo un error al actualizar la información de la pagina.")
                ->send();
        }

        redirect()
            ->route("dash.info")
            ->route("Se ha actualizado la información de la pagina correctamente.")
            ->send();
    }

    public function usuarios() {
        $usuarios = User::get();
        return self::render("dashboard.users", [
            "active" => "usuarios",
            "usuarios" => $usuarios,
        ]);
    }

    public function getUserInfo($id) {
        $response = [];
        if ($response["user"] = User::where("user_id", $id)->first()) {
            $response["status"] = [
                "code" => 200,
                "message" => "Información cargada"
            ];
        } else {
            $response["status"] = [
                "code" => 500,
                "message" => "Error al cargar la información"
            ];
        }
        echo json_encode($response);
    }

    public function setUserInfo() {
        $response = [];
        $data = Request::getData();



        if (User::where("user_id", $data["id"])->update([
            "user_nick" => $data["nick"],
            "user_name" => $data["name"],
            "user_lastname" => $data["lastname"],
            "user_email" => $data["email"],
            "user_address" => $data["address"],
            "user_phone" => $data["phone"],
        ])) {
            $response["status"] = [
                "code" => 200,
                "message" => "Información Actualizada",
            ];
        } else {
            $response["status"] = [
                "code" => 500,
                "message" => "Error al actualizar la información"
            ];
        }

        echo json_encode($response);
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

    public function getItem($id) {
        $data = [];

        $products = Product::getAllData($id);

        if (!$products) {
            $data["error"] = "Ubo un error al obtener los datos";
            echo json_encode($data);
            return;
        }

        $data[] = $products[0];
        echo json_encode($data);
    }

    public function getProv() {
        $data = [];
        $providers = Provider::get();
        if (!$providers) {
            $data["error"] = "No se ha podido obtener la lista de proveedores";
            echo json_encode($data);
            return;
        }

        $data = $providers;
        echo json_encode($data);
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

    public function setMenuImg($id) {
        if (!isset($_FILES["menu-img"])) redirect()->route("dash.menu")->error("No se ha seleccionado una image")->send();

        $menus = [
            "1" => "menu-bebidas",
            "2" => "menu-principal",
            "3" => "menu-comidas",
        ];

        $targetDir = "Public/img/menu/";
        $imageFileType = strtolower(pathinfo(basename($_FILES["menu-img"]["name"]), PATHINFO_EXTENSION));
        $targetFile = $targetDir . $menus[$id] . "." . $imageFileType;

        if (getimagesize($_FILES["menu-img"]["tmp_name"]) === false) redirect()->route("dash.menu")->error("Se ha seleccionado una imagen invalida")->send();
        if ($_FILES["menu-img"]["size"] > 500000) redirect()->route("dash.menu")->error("El tamaño de la imagen debe ser menor a 500kb")->send();
        if ($imageFileType != "jpg" && $imageFileType != "png") redirect()->route("dash.menu")->error("Solo se aceptan imágenes de tipo jpg y png")->send();
        if (move_uploaded_file($_FILES["menu-img"]["tmp_name"], $targetFile)) redirect()->route("dash.menu")->success("Se ha guardado la imagen con éxito")->send();
        else redirect()->route("dash.menu")->error("No se ha podido subir la imagen")->send();
    }

    public function reservas() {
        return self::render("dashboard.reservas", [
            "active" => "reservas",
            "reserves" => Reservation::select("rese_id", "rese_urid", "rese_status", "rese_time", "rese_date")->orderBy("rese_date", "ASC")->get(),
        ]);
    }

    public function eventos() {
        return self::render("dashboard.eventos", [
            "active" => "eventos"
        ]);
    }

    public function galeria() {
        return self::render("dashboard.galeria", [
            "active" => "galeria"
        ]);
    }
}