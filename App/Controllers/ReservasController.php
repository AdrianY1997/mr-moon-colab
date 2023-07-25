<?php

namespace FoxyMVC\App\Controllers;

use DateTime;
use DateTimeZone;
use FoxyMVC\App\Models\Reservation;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
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
            echo $data["urid"];
            $rese = Reservation::where("rese_urid", $data["urid"])->where("rese_status", "NOT LIKE", Reservation::CANCELLED)->first();
            if ($rese)
                redirect()->route("reserve.show", ["urid" => $rese->rese_urid])->send();
            else
                redirect()->route("reserve")->error("El id de reservación no existe en el sistema o ha sido cancelada")->send();
        }

        return self::render("web.reserve.search");
    }

    public function show($urid) {
        $rese = Reservation::where("rese_urid", $urid)->first();
        $date1 = new DateTime($rese->created_at, new DateTimeZone('America/Bogota'));
        $date2 = new DateTime('now', new DateTimeZone('America/Bogota'));
        $interval = $date2->getTimestamp() - $date1->getTimestamp();

        if (!$rese)
            redirect()->route("reserve")->error("La id de reservación no se encuentra en el sistema")->send();

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
            if ($key == "details")
                continue;

            if ($value == "")
                redirect()->route("reserve")->error("Se deben llenar los campos marcados (*)")->send();
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

        if (Reservation::insert($reservation))
            redirect()->route("reserve.show", ["urid" => $urid])->success("Su reserva se ha registrado, por favor confirme el pago dentro de 2 horas")->send();
        else
            redirect()->route("reserve")->error("No se ha podido registrar su reserva")->send();
    }

    public function confirm() {
        $data = Request::getData();
    }

    public function getHours() {

        header('Content-Type: application/json');
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType !== "application/json") {
            echo json_encode([
                "error" => "No se ha cargado la información correctamente"
            ]);
            return;
        }

        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        if (!is_array($decoded)) {
            echo json_encode([
                "error" => "No hay datos que procesar"
            ]);
            return;
        }

        $day = $decoded["day"];

        $result = Reservation::getHours($day);

        echo json_encode([
            "result" => $result,
        ]);
        return;
    }
}
