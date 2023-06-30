<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Reservation;
use FoxyMVC\App\Models\Role;
use FoxyMVC\Lib\Foxy\Core\Base\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;

class ReservasController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        render("web.reservas");
    }

    public function new() {
        $data = Request::getData();

        $userId = Session::checkSession() ? Session::data("user_id") : 1;
        $urid = sprintf("%s-%010s-%s", $userId, time(), uniqid(true));

        $wasRegistered = Reservation::insert([
            "rese_urid" => $urid,
            "rese_name" => $data["name"],
            "rese_lastname" => $data["lastname"],
            "rese_email" => $data["email"],
            "rese_table" => $data["table"],
            "rese_date" => $data["date"],
            "rese_time" => $data["time"],
            "rese_quantity" => $data["people"],
            "user_id" => $userId
        ]);

        if ($wasRegistered) redirect()->route("reserve.show", ["urid" => $urid])->success("Su reserva se ha registrado, por favor confirme el pago dentro de 2 horas")->send();
        else redirect()->route("reserve")->error("No se ha podido registrar su reserva")->send();
    }

    public function search() {
        $data = Request::getData();
        if (isset($data["urid"])) {
            echo $data["urid"];
            $rese = Reservation::where("rese_urid", $data["urid"])->first();
            if ($rese) redirect()->route("reserve.show", ["urid" => $rese->rese_urid])->send();
            else redirect()->route("reserve.search")->error("El id de reservación no existe en el sistema")->send();
        }

        render("web.reserve.search");
    }

    public function show($urid) {
        $rese = Reservation::where("rese_urid", $urid)->first();
        if (!$rese) {
            redirect()->route("reserve.search")->error("La id de reservación no se encuentra en el sistema")->send();
        }

        render("web.reserve.confirm", [
            "reservation" => $rese
        ]);
    }

    public function confirm() {
        $data = Request::getData();
    }
}
