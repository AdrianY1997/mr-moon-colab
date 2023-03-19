<?php

namespace App\Site\Controller;

use Lib\Foxy\Core\Base\Controller;


class InicioController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function toHome()
    {
        redirect()->route(constant("HOME"))->send();
    }

    function index()
    {
        render("home/home");
    }
}
