<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Role;
use FoxyMVC\App\Models\User;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Controller;

class AuthController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    private function checkRole() {
        if (!Session::checkSession()) {
            return;
        }

        $roles = Role::getUserRole(Session::data("user_id"));

        foreach ($roles as $role) {
            if ($role->role_name == Role::ADMIN) {
                redirect()
                    ->route("dash.home")
                    ->send();
                break;
            }
        }

        redirect()
            ->route("profile.show")
            ->send();
    }

    public function log_in() {
        $this->checkRole();
        return self::render("auth.login");
    }

    public function sign_up() {
        $this->checkRole();
        return self::render("auth.signup");
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