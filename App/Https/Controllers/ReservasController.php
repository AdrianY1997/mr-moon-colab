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

        $wasRegistered = Reservation::insert([
            "rese_name" => $data["name"],
            "rese_lastname" => $data["lastname"],
            "rese_email" => $data["email"],
            "rese_table" => $data["table"],
            "rese_date" => $data["date"],
            "rese_time" => $data["time"],
            "rese_quantity" => $data["people"],
            "user_id" => "1"
        ]);

        if ($wasRegistered) redirect()->route("reserve.show", ["id" => 1])->success("Se ha registrado su reserva correctamente")->send();
        else redirect()->route("reserve")->error("No se ha podido registrar su reserva")->send();
    }

    public function show($id) {

        $reservation = Reservation::where("rese_id", $id)->first();

        render("web.reserve.confirm", [
            "reservation" => $reservation
        ]);
    }

    public function confirm() {
        $data = Request::getData();
    }
}