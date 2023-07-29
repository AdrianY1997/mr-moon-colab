<?php

namespace FoxyMVC\App\Controllers;

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

        $randCode = rand(100000, 999999);

        $code = new Code();
        $code->code_email = $data->email;
        $code->code_code = $randCode;
        $code->code_status = Code::WAITING;

        Code::insert($code);

        Response::json(["code" => $randCode]);
    }

    public function verify_recovery_code() {
    }
}
