<?php

namespace FoxyMVC\App\Https\Controllers;

use FoxyMVC\App\Models\Menu;
use FoxyMVC\Lib\Foxy\Core\Controller;

class MenuController extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        return self::render("web.menu", [
            "menus" => Menu::select("menu_path")->get()
        ]);
    }
}