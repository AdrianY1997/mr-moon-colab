<?php

namespace App\Site\Controllers;

use App\Site\Models\User;
use Lib\Foxy\Core\Base\Controller;
use Lib\Foxy\Core\Request;
use Lib\Foxy\Core\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (Session::checkSession())
            redirect()->route("dash.home");
    }

    public function log_in()
    {
        render("auth/log_in");
    }

    public function sign_up()
    {
        render("auth/sign_up");
    }

    public function recovery()
    {
        render("auth/recovery");
    }

    public function start_session()
    {
        $data = Request::getData();

        $user = new User();

        $user = $user->getAll(["user_email" => $data["email"]]);

        Session::setMessage("email", $data["email"]);

        if (!isset($user[0])) {
            Session::setMessage("error", "El correo ingresado no se encuentra registrado en la base de datos");
        } else {
            $user = $user[0];
            if (!password_verify($data["password"], $user["password"]))
                Session::setMessage("error", "La contraseña ingresada no coincide con el correo");
        }
        if (Session::checkError())
            redirect()->route("auth.login");


        if (Session::save($user["name"]))
            Session::setMessage("success", "Haz iniciado sesión correctamente");

        redirect()->route("dash.home");
    }

    public function close_session()
    {

        Session::destroy();
        redirect()->route(constant("HOME"));
    }
}
