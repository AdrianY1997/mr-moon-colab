<?php

namespace FoxyMVC\App\Controllers;

use DateTime;
use DateTimeZone;
use FoxyMVC\App\Models\Reservation;
use FoxyMVC\Lib\Cli\Command\Migration\Reset;
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
            $rese = Reservation::where("rese_urid", $data["urid"])->first();
            if (!$rese) {
                redirect()
                    ->route("reserve")
                    ->error("El id de reservación no existe en el sistema, por favor revise correctamente y vuelva a intentarlo.")
                    ->send();
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
            $rese->rese_status = Reservation::CANCELLED;
            $rese->model->update();
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
        $reservation->rese_status = Reservation::WAITING_FOR_PAYMENT;
        $reservation->rese_quantity = $data["people"];
        $reservation->rese_details = $data["details"];
        $reservation->rese_method = "";
        $reservation->rese_pay_img = "";
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
        Response::checkMethod("POST");

        $data = Request::getFormData();

        $file = $_FILES['image'];
        $tmp_name = $file['tmp_name'];
        $name = time() . $data["urid"] . "." . pathinfo($file["name"], PATHINFO_EXTENSION);
        $path = "Public/img/facturas/" . $name;

        if (!move_uploaded_file($tmp_name, $path)) {
            Response::status(500)->end("No ha sido posible guardar su factura, contacte con administración");
        }

        $reservation = Reservation::where("rese_urid", $data["urid"])->first();
        $reservation->rese_status = Reservation::WAITING_FOR_CONFIRMATION;
        $reservation->rese_method = $data["pay-selected"];
        $reservation->rese_pay_img = $path;

        if (!$reservation->model->update()) {
            unlink($path);
            Response::status(500)->end("Ha ocurrido un error en la operación, contacte con administración");
        }

        // var_dump($reservation);
        // Response::status(200)->end($file);
    }

    public function getHours() {
        $data = Request::getFormData();

        $result = Reservation::getHours($data->day);

        if ($result === false) {
            Response::status(500)->end("Ha ocurrido un error inesperado");
        }

        Response::status(200)->json(["hours" => $result]);
    }

    public function get() {
        Response::checkMethod("POST");

        $data = Request::getFormData();

        $selectText = isset($data->all) ? ["*"] : ["rese_urid", "rese_status"];

        
        $status = isset($data->status) ? ["rese_status", explode("-", $data->status)[0]] : ["rese_status", "!=", "null"];
        $urid = isset($data->urid) ? ["rese_urid", $data->urid] : ["rese_urid", "!=", "null"];
        
        $rese = Reservation::select(...$selectText)->where(...$urid)->where(...$status)->get();

        if ($rese === false) {
            Response::status(500)->end("Ha ocurrido un error al obtener los datos");
        }
        
        $newRese = array_map(function ($r) {
            unset($r->model, $r->fillable);
            $r->rese_status = Reservation::getText($r->rese_status);
            return $r;
        }, $rese);
        
        Response::json($newRese);
    }

    public function confirmPayment() {
        Response::checkMethod("POST");

        $data = Request::getFormData();

        $rese = Reservation::where("rese_urid", $data->urid)->first();
        $rese->rese_status = Reservation::RESERVED;
        $rese->model->update();

        Response::json([
            "text" => "Se ha actualizado el estado de la reservación",
            "status" => Reservation::getText(Reservation::RESERVED),
        ]);
    }

    public function cancelPayment() {
        Response::checkMethod("POST");

        $data = Request::getFormData();

        $rese = Reservation::where("rese_urid", $data->urid)->first();
        $rese->rese_status = Reservation::CANCELLED;
        $rese->rese_details = $data->details;
        $rese->model->update();

        Response::json([
            "text" => "Se ha actualizado el estado de la reservación",
            "status" => Reservation::getText(Reservation::CANCELLED),
        ]);
    }
}
