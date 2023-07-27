<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Code;
use FoxyMVC\App\Models\Role;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;

class RecoveryController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function recovery() {
        if (Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name == Role::ADMIN) redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }
        return self::render("auth.recovery");
    }

    public function request_recovery_code() {
        $data = Request::getData();

        if (filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $randCode = rand(100000, 999999);

            $code = new Code();
            $code->code_email = $data["email"];
            $code->code_code = $randCode;
            $code->code_status = "waiting";

            Code::insert($code);
            echo json_encode(["code" => $randCode]);
        } else {
            echo json_encode(["error" => "El email ingresado no existe", "code" => 1]);
        }
    }

    public function verify_recovery_code() {
    }
}