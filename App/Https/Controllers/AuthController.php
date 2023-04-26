<?php

namespace App\Https\Controllers;

use App\Models\Code;
use App\Models\User;
use Lib\Foxy\Core\Base\Controller;
use Lib\Foxy\Core\Request;
use Lib\Foxy\Core\Session;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (Session::checkSession())
            redirect()->route("dash.home")->send();
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

    public function request_recovery_code()
    {
        $data = Request::getData();

        $code = new Code();
        $randCode = rand(100000, 999999);

        $code->insert("codes", [
            "email" => $data["email"],
            "code" => $randCode,
            "status" => "waiting"
        ]);
    }

    public function verify_recovery_code()
    {
        // $data = Request::getData();

        // $code = new Code();

        // $x = $code->get("*", [
        //     "code_email" => $data["email"],
        //     "code_code" => $data["code"]
        // ]);

        // var_dump($x);
    }

    public function start_session()
    {
        $data = Request::getData();

        $user = new User();

        $user = $user->getAll(["user_email" => $data["email"]]);
        if (!isset($user[0])) {
            Session::setMessage("error", "El correo ingresado no se encuentra registrado en la base de datos");
            redirect()->route("auth.login")->send();
        } else {
            $user = $user[0];
            if (!password_verify($data["password"], $user["user_pass"])) {
                var_dump($data, $user);
                Session::setMessage("error", "La contraseña ingresada no coincide con el correo");
            } else if (Session::save($user["user_name"]))
                Session::setMessage("success", "Haz iniciado sesión correctamente");
        }
        if (Session::checkError())
            redirect()->route("auth.login");

        redirect()->route("dash.home")->send();
    }

    public function close_session()
    {
        Session::destroy();
        redirect()->route(constant("HOME"))->send();
    }
}
