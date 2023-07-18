<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Reservation;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;

class ReservasController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return self::render("web.reservas");
    }

    public function new() {
        $data = Request::getData();

        $userId = Session::checkSession() ? Session::data("user_id") : 1;
        $urid = sprintf("%s-%010s-%s", $userId, time(), uniqid(true));

        $reservation = new Reservation();
        $reservation->rese_urid = $urid;
        $reservation->rese_name = $data["name"];
        $reservation->rese_lastname = $data["lastname"];
        $reservation->rese_email = $data["email"];
        $reservation->rese_table = $data["table"];
        $reservation->rese_date = $data["day"];
        $reservation->rese_time = $data["time"];
        $reservation->rese_status = "PENDING";
        $reservation->rese_quantity = $data["people"];
        $reservation->user_id = $userId;

        if (Reservation::insert($reservation))
            redirect()->route("reserve.show", ["urid" => $urid])->success("Su reserva se ha registrado, por favor confirme el pago dentro de 2 horas")->send();
        else
            redirect()->route("reserve")->error("No se ha podido registrar su reserva")->send();
    }

    public function search() {
        $data = Request::getData();
        if (isset($data["urid"])) {
            echo $data["urid"];
            $rese = Reservation::where("rese_urid", $data["urid"])->first();
            if ($rese) redirect()->route("reserve.show", ["urid" => $rese->rese_urid])->send();
            else redirect()->route("reserve.search")->error("El id de reservación no existe en el sistema")->send();
        }

        return self::render("web.reserve.search");
    }

    public function show($urid) {
        $rese = Reservation::where("rese_urid", $urid)->first();
        if (!$rese) {
            redirect()->route("reserve.search")->error("La id de reservación no se encuentra en el sistema")->send();
        }

        return self::render("web.reserve.confirm", [
            "reservation" => $rese
        ]);
    }

    public function confirm() {
        $data = Request::getData();
    }
}
