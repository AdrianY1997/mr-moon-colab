<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Event;
use FoxyMVC\App\Models\User;
use FoxyMVC\Lib\Foxy\Core\Base\Controller;
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
}