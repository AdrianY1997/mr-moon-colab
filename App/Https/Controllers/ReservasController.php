<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Reservation;
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

    public function show($id = null) {

        if ($id) {
            $reservation = Reservation::where("rese_urid", $id)->get();
            render("web.reserve.confirm", [
                "id" => $id,
                "reservation" => $reservation
            ]);
        } else {
            render("web.reserve.search");
        }
    }

    public function confirm() {
        $data = Request::getData();
    }
}