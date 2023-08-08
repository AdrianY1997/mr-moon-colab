<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\Role;
use FoxyMVC\App\Models\User;
use FoxyMVC\App\Packages\Privileges;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;

class UserController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function new_user() {
        (new AuthController())->checkRole();

        $data = Request::getData();

        $user = User::where("user_email", $data["email"])
            ->first();
        if ($user) {
            redirect()
                ->route("auth.signup")
                ->error("El correo ingresado no esta disponible")
                ->send();
        }

        if (!preg_match('/^(?=.*[A-Z])(?=.{8,16})(?=.*[!@#$%^&*.()_+-]).*$/', $data["password"])) {
            redirect()
                ->route("auth.signup")
                ->error("La contraseña debe contener entre 8 y 16 caracteres, 1 letra mayúscula y un carácter especial")
                ->send();
        }

        if(!is_numeric($data["number"])){
            redirect()->route("profile.show")->error("Solo se aceptan numeros")->send();
        }

        $user = new User();

        $user->user_email = $data["email"];
        $user->user_address = $data["address"];
        $user->user_pass =  password_hash($data["password"], PASSWORD_DEFAULT);
        $user->user_name = $data["name"];
        $user->user_lastname = $data["lastname"];
        $user->user_phone = $data["number"];
        $user->user_img_path = "img";
        $user->user_nick = $data["name"] . $data["lastname"] . random_int(1, 9);
        $user->user_privileges = Privileges::User->get();

        if (!User::insert($user)) {
            redirect()
                ->route("auth.signup")
                ->error("No se ha podido agregar el usuario, contacte con un administrador")
                ->send();
        }

        redirect()
            ->route("auth.login")
            ->success("Usted se ha registrado con éxito, por favor inicie sesión para continuar")
            ->send();
    }

    public function delete_user($user_id) {
        if (!Session::checkSession() || (Privileges::Admin->get() & Session::data("user_privileges") != Privileges::Admin->get())) {
            redirect()
                ->route("error", ["msg" => "missing-permissions"])
                ->send();
        }

        if (!User::where("user_id", $user_id)->delete()) {
            redirect()
                ->route("dash.users")
                ->error("No se ha podido eliminar el usuario")
                ->send();
        }

        redirect()
            ->route("dash.users")
            ->error("El usuario se ha eliminado con éxito")
            ->send();
    }
}
