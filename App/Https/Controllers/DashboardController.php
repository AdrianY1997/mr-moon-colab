<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Webdata;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Base\Controller;

class DashboardController extends Controller {
    public function __construct() {
        parent::__construct();

        if (!Session::checkSession()) redirect()->route("auth.login")->send();
    }

    public function index() {
        redirect()->route("dash.home")->send();
    }

    public function inicio() {
        render("dashboard.home", [
            "active" => "home"
        ]);
    }

    public function info() {
        render("dashboard.info", [
            "active" => "info",
        ]);
    }

    public function updateWebInfo() {
        $data = Request::getData();

        $webdata = new Webdata();

        if (password_verify($data["password"], Session::data("password")))
            if ($webdata->update(["webd_id" => 1], [
                "webd_name" => $data["name"],
                "webd_subt" => $data["subt"],
                "webd_email" => $data["email"],
                "webd_phone" => $data["phone"],
                "webd_address" => $data["address"],
                "webd_city" => $data["city"],
                "webd_fblink" => $data["fblink"],
                "webd_twlink" => $data["twlink"],
                "webd_iglink" => $data["iglink"],
                "webd_ytlink" => $data["ytlink"],
            ])) Session::setMessage("success", "Se ha actualizado la información de la pagina correctamente.");
            else Session::setMessage("error", "Ubo un error al actualizar la información de la pagina.");
        else Session::setMessage("error", "No se pudo actualizar, por que la contraseña no coincide con tu usuario");

        redirect()->route("dash.info")->send();
    }

    public function usuarios() {
        render("dashboard.users", [
            "active" => "usuarios"
        ]);
    }

    public function inventario() {
        render("dashboard.inv", [
            "active" => "inventario"
        ]);
    }

    public function facturas() {
        render("dashboard.fact", [
            "active" => "facturas"
        ]);
    }

    public function menu() {
        render("dashboard.menu", [
            "active" => "menu"
        ]);
    }

    public function reservas() {
        render("dashboard.reservas", [
            "active" => "reservas"
        ]);
    }

    public function eventos() {
        render("dashboard.eventos", [
            "active" => "eventos"
        ]);
    }

    public function galeria() {
        render("dashboard.galeria", [
            "active" => "galeria"
        ]);
    }
}
