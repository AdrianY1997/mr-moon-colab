<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Role;
use FoxyMVC\App\Models\User;
use FoxyMVC\App\Models\UserRole;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;

class UserController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function new_user() {
        if (Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name == "ADMIN") redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }
        $data = Request::getData();

        $user = User::where("user_email", $data["email"])->first();
        if ($user) {
            redirect()->route("auth.signup")->error("El usuario ingresado no esta disponible")->send();
        } else {

            if (preg_match('/^(?=.*[A-Z])(?=.{8,16})(?=.*[!@#$%^&*()_+-]).*$/', $data["password"])) redirect()->route("auth.signup")->error("La contraseña debe contener entre 8 y 16 caracteres, 1 letra mayúscula y un carácter especial")->send();
            User::insert([
                "user_email" => $data["email"],
                "user_pass" =>  password_hash($data["password"], PASSWORD_DEFAULT),
                "user_name" => $data["name"],
                "user_lastname" => $data["lastname"],
                "user_phone" => $data["number"],
            ]);
            $user = User::select("user_id")->where("user_email", $data["email"])->where("user_name", $data["name"])->first();
            $role = Role::select("role_id")->where("role_name", "USER")->first();
            UserRole::insert([
                "user_id" => $user->user_id,
                "role_id" => $role->role_id
            ]);
            redirect()->route("auth.login")->success("Te haz registrado con éxito")->send();
        }
    }

    public function delete_user($user_id) {
        $role = Role::getUserRole(Session::data()->user_id);
        if (!Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name != "ADMIN") redirect()->route("error", ["msg" => "missing-permissions"])->send();
            }
        }

        if (UserRole::where("user_id", $user_id)->delete() && User::where("user_id", $user_id)->delete()) {
            redirect()->route("dash.users")->success("Se ha eliminado el usuario $user_id con éxito")->send();
        } else {
            redirect()->route("dash.users")->error("Ocurrió un error al eliminar el usuario $user_id")->send();
        }
    }
}