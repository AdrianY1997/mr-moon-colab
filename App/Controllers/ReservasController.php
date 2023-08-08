<?php

namespace FoxyMVC\App\Controllers;

use DateTime;
use DateTimeZone;
use FoxyMVC\App\Models\Reservation;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Response;
use FoxyMVC\Lib\Foxy\Core\Session;

class ReservasController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return self::render("web.reservas", [
            "now" => date("Y-m-d")
        ]);
    }

    public function search() {
        $data = Request::getData();
        if (isset($data["urid"])) {
            $rese = Reservation::where("rese_urid", $data["urid"])->where("rese_status", "NOT LIKE", Reservation::CANCELLED)->first();
            if (!$rese) {
                redirect()->route("reserve")->error("El id de reservación no existe en el sistema o ha sido cancelada")->send();
            }

            redirect()->route("reserve.show", ["urid" => $rese->rese_urid])->send();
        }

        return self::render("web.reserve.search");
    }

    public function show($urid) {
        $rese = Reservation::where("rese_urid", $urid)->first();
        $date1 = new DateTime($rese->created_at, new DateTimeZone('America/Bogota'));
        $date2 = new DateTime('now', new DateTimeZone('America/Bogota'));
        $interval = $date2->getTimestamp() - $date1->getTimestamp();

        if (!$rese) {
            redirect()->route("reserve")->error("La id de reservación no se encuentra en el sistema")->send();
        }

        if ($interval > 7200) {
            Reservation::where("rese_urid", $urid)->update([
                "rese_status" => Reservation::CANCELLED
            ]);
            redirect()->route("reserve")->error("El tiempo de espera para la confirmación ha finalizado y su reserva se cancelo. vuelva a intentarlo")->send();
        }

        return self::render("web.reserve.confirm", [
            "reservation" => $rese
        ]);
    }

    public function new() {
        $data = Request::getData();

        $userId = Session::checkSession() ? Session::data("user_id") : 1;
        $urid = sprintf("%s-%010s-%s", $userId, time(), uniqid(true));

        foreach ($_POST as $key => $value) {
            if ($key == "details") {
                continue;
            }

            if ($value == "") {
                redirect()
                    ->route("reserve")
                    ->error("Se deben llenar los campos marcados (*)")
                    ->send();
            }
        }

        $reservation = new Reservation();
        $reservation->rese_urid = $urid;
        $reservation->rese_name = $data["name"];
        $reservation->rese_lastname = $data["lastname"];
        $reservation->rese_email = $data["email"];
        $reservation->rese_table = $data["table"];
        $reservation->rese_day = $data["day"];
        $reservation->rese_time = $data["time"];
        $reservation->rese_status = "PENDING";
        $reservation->rese_quantity = $data["people"];
        $reservation->rese_details = $data["details"];
        $reservation->user_id = $userId;

        if (!Reservation::insert($reservation)) {
            redirect()
                ->route("reserve")
                ->error("No se ha podido registrar su reserva")
                ->send();
        }

        redirect()
            ->route("reserve.show", ["urid" => $urid])
            ->success("Su reserva se ha registrado, por favor confirme el pago dentro de 2 horas")
            ->send();
    }

    public function confirm() {
        $data = Request::getData();
    }

    public function getHours() {
        $data = Request::getFormData();

        $result = Reservation::getHours($data->day);

        if ($result === false) {
            Response::status(500)->end("Ha ocurrido un error inesperado");
        }

        Response::status(200)->json(["hours" => $result]);
    }
}
