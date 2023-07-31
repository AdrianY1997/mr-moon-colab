<?php

namespace FoxyMVC\App\Controllers;

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
                if ($role->role_name == Role::ADMIN) redirect()->route("dash.home")->send();
            }
            redirect()->route("profile.show")->send();
        }
        $data = Request::getData();

        $user = User::where("user_email", $data["email"])->first();
        if ($user) {
            redirect()->route("auth.signup")->error("El correo ingresado no esta disponible")->send();
        }

        if (!preg_match('/^(?=.*[A-Z])(?=.{8,16})(?=.*[!@#$%^&*()_+-]).*$/', $data["password"]))
            redirect()->route("auth.signup")->error("La contraseña debe contener entre 8 y 16 caracteres, 1 letra mayúscula y un carácter especial")->send();

        $user = new User();

        $user->user_email = $data["email"];
        $user->user_address = $data["address"];
        $user->user_pass =  password_hash($data["password"], PASSWORD_DEFAULT);
        $user->user_name = $data["name"];
        $user->user_lastname = $data["lastname"];
        $user->user_phone = $data["number"];
        $user->user_img_path = "img";
        $user->user_nick = $data["name"] . $data["lastname"] . random_int(1, 9);

        User::insert($user);
        $user = User::select("user_id")->where("user_email", $data["email"])->where("user_name", $data["name"])->first();
        $role = Role::select("role_id")->where("role_name", Role::USER)->first();

        $userRole = new UserRole();
        $userRole->user_id = $user->user_id;
        $userRole->role_id = $role->role_id;

        UserRole::insert($userRole);
        redirect()->route("auth.login")->success("Te haz registrado con éxito")->send();
    }

    public function delete_user($user_id) {
        $role = Role::getUserRole(Session::data()->user_id);
        if (!Session::checkSession()) {
            $roles = Role::getUserRole(Session::data("user_id"));
            foreach ($roles as $role) {
                if ($role->role_name != Role::ADMIN) redirect()->route("error", ["msg" => "missing-permissions"])->send();
            }
        }

        if (UserRole::where("user_id", $user_id)->delete() && User::where("user_id", $user_id)->delete()) {
            redirect()->route("dash.users")->success("Se ha eliminado el usuario $user_id con éxito")->send();
        } else {
            redirect()->route("dash.users")->error("Ocurrió un error al eliminar el usuario $user_id")->send();
        }
    }
}
