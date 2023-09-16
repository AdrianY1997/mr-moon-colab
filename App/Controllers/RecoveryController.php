<?php

namespace FoxyMVC\App\Controllers;

use DateTime;
use DateTimeZone;
use FoxyMVC\App\Models\Code;
use FoxyMVC\App\Models\User;
use FoxyMVC\App\Packages\Privileges;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Response;
use FoxyMVC\Lib\Foxy\Core\Session;

class RecoveryController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function recovery() {
        if (Session::checkSession()) {
            if ((Privileges::Admin->get() & Session::data("user_privileges") != Privileges::Admin->get())) {
                redirect()
                    ->route("error", ["msg" => "missing-permissions"])
                    ->send();
            }

            redirect()->route("profile.show")->send();
        }

        return self::render("auth.recovery");
    }

    public function request_recovery_code() {
        Response::checkMethod("POST");

        $data = Request::getFormData();

        if (!filter_var($data->email, FILTER_VALIDATE_EMAIL)) {
            Response::status(401)->end("El email ingresado es invalido");
        }

        $user = User::where("user_email", $data->email)->first();

        if (!$user) {
            Response::status(401)->end("El email ingresado no se encuentra registrado");
        }

        $code = Code::where("code_email", $data->email)->where("code_status", Code::WAITING)->first();

        if($code) {
            Response::status(401)->end("Ya existe un código de verificación. Revisa tu mail en inténtalo de nuevo.");
        }



        $randCode = rand(100000, 999999);

        $code = new Code();
        $code->code_email = $data->email;
        $code->code_code = $randCode;
        $code->code_status = Code::WAITING;

        if (!Code::insert($code)) {
            Response::status(500)->end("No se ha podido guardar el codigo, contacte con el administrador");
        }

        Response::json(["code" => $randCode]);
    }

    public function verify_recovery_code() {
        Response::checkMethod("POST");

        $data = Request::getFormData();

        $code = Code::where("code_code", $data->code)->where("code_email", $data->email)->first();

        if (!$code) {
            Response::status(401)->end("El código ingresado no coincide.");
        }

        $date1 = new DateTime($code->created_at, new DateTimeZone('America/Bogota'));
        $date2 = new DateTime('now', new DateTimeZone('America/Bogota'));
        $interval = $date2->getTimestamp() - $date1->getTimestamp();

        if ($interval > 7200) {
            $code->code_status = Code::CANCELLED;

            if ($code->model->update()){
                Response::status(401)->end("El codigo de recuperación expiró, vuelve a generarlo nuevamente.");
            }

            Response::status(500)->end("El código expiró, pero no puede ser actualizado. Contacte con el administrador.");
        }
    }
    public function new_pass() {
        Response::checkMethod("POST");

        $data = Request::getFormData();

        $code = Code::where("code_code", $data->code)->where("code_email", $data->email)->first();

        if (!$code) {}
    }
}
