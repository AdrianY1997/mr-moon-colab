<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Code;
use FoxyMVC\App\Models\Role;
use FoxyMVC\App\Models\User;
use FoxyMVC\App\Models\UserRole;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Base\Controller;
use FoxyMVC\Lib\Foxy\Database\MySQL;

class AuthController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function log_in() {
        if (Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name == "ADMIN") redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }
        render("auth.login");
    }

    public function sign_up() {
        if (Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name == "ADMIN") redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }
        render("auth.signup");
    }

    public function recovery() {
        if (Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name == "ADMIN") redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }
        render("auth.recovery");
    }

    public function request_recovery_code() {
        if (Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name == "ADMIN") redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }
        $data = Request::getData();

        if (filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $randCode = rand(100000, 999999);

            Code::insert([
                "code_email" => $data["email"],
                "code_code" => $randCode,
                "code_status" => "waiting"
            ]);
            echo json_encode(["code" => $randCode]);
        } else {
            echo json_encode(["error" => "El email ingresado no existe", "code" => 1]);
        }
    }

    public function verify_recovery_code() {
        if (Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name == "ADMIN") redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }

        // $data = Request::getData();

        // $code = new Code();

        // $x = $code->get("*", [
        //     "code_email" => $data["email"],
        //     "code_code" => $data["code"]
        // ]);

        // var_dump($x);
    }

    public function start_session() {
        if (Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name == "ADMIN") redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }
        $data = Request::getData();

        $user = User::select("user_nick", "user_email", "user_name", "user_pass")->where("user_email", $data["email"])->first();

        if (!$user) {
            redirect()->route("auth.login")->error("El correo no se encuentra registrado")->send();
        } else {
            if (!password_verify($data["password"], $user->user_pass)) {
                redirect()->route("auth.login")->error("La contraseña ingresada no coincide con el correo")->send();
            } else if (Session::save($user->user_name)) {
                Session::load();
                $roles = Role::getUserRole(Session::data("user_id"));
                foreach ($roles as $role) {
                    if ($role->role_name == "ADMIN") redirect()->route("dash.home")->success("Haz iniciado sesión correctamente")->send();
                }
                redirect()->route("profile.show")->success("Haz iniciado sesión correctamente")->send();
            }
            redirect()->route(constant("HOME"))->error("Ha ocurrido un error");
        }
    }

    public function close_session() {
        Session::destroy();
        redirect()->route(constant("HOME"))->success("Se ha cerrado sesión correctamente")->send();
    }
}