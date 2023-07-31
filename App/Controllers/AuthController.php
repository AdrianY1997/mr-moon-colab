<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\User;
use FoxyMVC\App\Packages\Privileges;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Controller;

class AuthController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function log_in() {
        $this->checkRole();
        return self::render("auth.login");
    }

    public function sign_up() {
        $this->checkRole();
        return self::render("auth.signup");
    }

    public function checkRole() {
        if (!Session::checkSession()) {
            return;
        }

        if ((Privileges::Admin->get() & Session::data("user_privileges")) == Privileges::Admin->get()) {
            redirect()
                ->route("dash.home")
                ->success("Haz iniciado sesión correctamente")
                ->send();
        }

        if ((Privileges::User->get() & Session::data("user_privileges")) == Privileges::User->get()) {
            redirect()
                ->route("profile.show")
                ->success("Haz iniciado sesión correctamente")
                ->send();
        }
        // Code::where("code_email", )->where()->()

        
    }

    public function start_session() {
        $this->checkRole();
        $data = Request::getData();
        $user = User::select("user_nick", "user_email", "user_name", "user_pass")
            ->where("user_email", $data["email"])
            ->first();

        if (!$user) {
            redirect()
                ->route("auth.login")
                ->error("El correo no se encuentra registrado")
                ->send();
        }

        if (!password_verify($data["password"], $user->user_pass)) {
            redirect()
                ->route("auth.login")
                ->error("La contraseña ingresada no coincide con el correo")
                ->send();
        }

        Session::save($user->user_email);
        Session::load();
        $this->checkRole();
    }

    public function close_session() {
        Session::destroy();
        redirect()
            ->route(constant("HOME"))
            ->success("Se ha cerrado sesión correctamente")
            ->send();
    }
}
