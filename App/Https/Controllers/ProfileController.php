<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Event;
use FoxyMVC\App\Models\User;
use FoxyMVC\Lib\Foxy\Core\Base\Controller;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;

class ProfileController extends Controller {
    public function __construct() {
        parent::__construct();
        if (!Session::checkSession()) {
            redirect()->route("error", ["msg" => "missing-permissions"])->send();
        }
    }

    public function show() {
        $user = Session::data();
        render("web.profile", [
            "user" => $user
        ]);
    }

    public function edit() {
        $data = Request::getData();
        $user = User::where("user_email", $data["email"])->first();
        if (password_verify($data["pass"], $user->user_pass))
            if (User::where("user_email", $data["email"])->update([
                "user_nick" => $data["nick"],
                "user_pass" => password_hash($data["new-pass"], PASSWORD_DEFAULT),
                "user_name" => $data["name"],
                "user_lastname" => $data["lastname"],
                "user_address" => $data["address"],
                "user_phone" => $data["phone"],
            ])) redirect()->route("profile.show")->success("Se ha actualizado tus datos correctamente")->send();
            else redirect()->route("profile.show")->success("Ha ocurrido un error al actualizar tus datos, contacte con un administrador")->send();
        else redirect()->route("profile.show")->error("Debes ingresar tu contraseña antigua para realizar cambios en tu perfil")->send();
    }
}