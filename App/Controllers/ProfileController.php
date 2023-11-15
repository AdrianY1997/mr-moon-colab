<?php

namespace FoxyMVC\App\Controllers;

use FoxyMVC\App\Models\User;
use FoxyMVC\App\Packages\Privileges;
use FoxyMVC\Lib\Foxy\Core\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Response;
use FoxyMVC\Lib\Foxy\Core\Session;

class ProfileController extends Controller {
    public function __construct() {
        parent::__construct();
        if (!Session::checkSession()) {
            redirect()->route("error", ["msg" => "missing-permissions"])->send();
        }
    }

    public function add() {
        if (!Privileges::check(Privileges::Master->get())) {
            redirect()
                ->route(constant("HOME"))
                ->error("No tiene permisos para acceder a este recurso")
                ->send();
        }

        $data = Request::getData();
        $data["priv-generated"] = $data["priv-user"] ?? 0 + $data["priv-admin"] ?? 0 + $data["priv-master"] ?? 0;

        $user = new User();
        $user->user_address = $data["address"];
        $user->user_email = $data["email"];
        $user->user_lastname = $data["last"];
        $user->user_name = $data["name"];
        $user->user_nick = $data["nick"];
        $user->user_pass = password_hash($data["pass"], PASSWORD_DEFAULT);
        $user->user_phone = $data["phone"];
        $user->user_img_path = "img";
        $user->user_privileges = $data["priv-generated"];

        if (!User::insert($user)) {
            redirect()
                ->route("dash.users")
                ->error("No se pudo guardar el usuario en la base de datos")->send();
        }

        redirect()
            ->route("dash.users")
            ->success("Se ha guardado el usuario correctamente")->send();
    }

    public function getProfileInfo() {
        $data = Request::getFormData();
        $userList = User::where("user_nick", $data->user)->orWhere("user_email", $data->email)->get();
        return Response::json(["isStored" => count($userList) == 0 ? false : true]);
    }

    public function show() {
        $user = Session::data();
        return self::render("web/profile", [
            "user" => $user
        ]);
    }

    public function edit() {
        $data = Request::getData();
        $user = User::where("user_email", $data["email"])->first();

        if (!password_verify($data["pass"], $user->user_pass)) {
            redirect()->route("profile.show")->error("Debes ingresar tu contraseña antigua para realizar cambios en tu perfil")->send();
        }

        if($data["new-pass"] == $data["pass"]){
            redirect()->route("profile.show")->error("Las contraseñas son las mismas")->send();
        }

        if(!is_numeric($data["phone"])){
            redirect()->route("profile.show")->error("Solo se aceptan numeros")->send();
        }

        if ($data["new-pass"] == "") {
            $isUpdated = User::where("user_email", $data["email"])->update([
                "user_nick" => $data["nick"],
                "user_pass" => $user->user_pass,
                "user_name" => $data["name"],
                "user_lastname" => $data["lastname"],
                "user_address" => $data["address"],
                "user_phone" => $data["phone"],
            ]);
        } else {
            if (preg_match('/^(?=.*[A-Z])(?=.{8,16})(?=.*[!@#$%^&*.()_+-]).*$/', $data["new-pass"])) {
                $isUpdated = User::where("user_email", $data["email"])->update([
                    "user_nick" => $data["nick"],
                    "user_pass" => password_hash($data["new-pass"], PASSWORD_DEFAULT),
                    "user_name" => $data["name"],
                    "user_lastname" => $data["lastname"],
                    "user_address" => $data["address"],
                    "user_phone" => $data["phone"],
                ]);
            } else {
                redirect()
                    ->route("profile.show")
                    ->error("La contraseña debe contener entre 8 y 16 caracteres, 1 letra mayúscula y un carácter especial")
                    ->send();
            }
        }

        if (!$isUpdated)
            redirect()
                ->route("profile.show")
                ->success("Ha ocurrido un error al actualizar tus datos, contacte con un administrador")
                ->send();

        redirect()
            ->route("profile.show")
            ->success("Se ha actualizado tus datos correctamente")
            ->send();
    }
}
