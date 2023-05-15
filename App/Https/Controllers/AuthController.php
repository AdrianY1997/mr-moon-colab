<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Code;
use FoxyMVC\App\Models\User;
use FoxyMVC\Lib\Foxy\Core\Request;
use FoxyMVC\Lib\Foxy\Core\Session;
use FoxyMVC\Lib\Foxy\Core\Base\Controller;

class AuthController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function log_in() {
        if (Session::checkSession()) redirect()->route("dash.home")->send();
        render("auth.login");
    }

    public function sign_up() {
        if (Session::checkSession()) redirect()->route("dash.home")->send();
        render("auth.signup");
    }

    public function recovery() {
        if (Session::checkSession()) redirect()->route("dash.home")->send();
        render("auth.recovery");
    }

    public function request_recovery_code() {
        if (Session::checkSession()) redirect()->route("dash.home")->send();
        $data = Request::getData();

        $code = new Code();
        $randCode = rand(100000, 999999);

        $code->insert(["codes"], [
            "email" => $data["email"],
            "code" => $randCode,
            "status" => "waiting"
        ]);
    }

    public function verify_recovery_code() {
        if (Session::checkSession()) redirect()->route("dash.home")->send();
        // $data = Request::getData();

        // $code = new Code();

        // $x = $code->get("*", [
        //     "code_email" => $data["email"],
        //     "code_code" => $data["code"]
        // ]);

        // var_dump($x);
    }

    public function start_session() {
        if (Session::checkSession()) redirect()->route("dash.home")->send();
        $data = Request::getData();

        $user = new User();

        $user = $user->getAll(["user_email" => $data["email"]]);
        if (!isset($user[0])) {
            redirect()->route("auth.login")->with("error:El correo no se encuentra registrado")->send();
        } else {
            $user = $user[0];
            if (!password_verify($data["password"], $user["user_pass"])) {
                redirect()->route("auth.login")->with("error:La contraseña ingresada no coincide con el correo")->send();
            } else if (Session::save($user["user_name"]))
                redirect()->route("dash.home")->with("success:Haz iniciado sesión correctamente")->send();

            redirect()->route(constant("HOME"))->with("error:Ha ocurrido un error");
        }
    }

    public function close_session() {
        Session::destroy();
        redirect()->route(constant("HOME"))->send();
    }

    public function new_user() {
        if (Session::checkSession()) redirect()->route("dash.home")->send();
        $data = Request::getData();

        $user = new User();
        $usera = $user->getAll(["user_email" => $data["email"]]);
        if(isset($usera[0])){
            Session::setMessage("error", "Correo ya registrado");
            redirect()->route("auth.signup")->send();
        }else{
            $user->insert([
            "user_email" => $data["email"],
            "user_pass" =>  password_hash($data["password"], PASSWORD_DEFAULT),
            "user_name" => $data["name"],
            "user_lastname" => $data["lastname"], 
            "user_phone" => $data["number"], 
        ]);
         redirect()->route("auth.login")->send();
        }   
    }
}