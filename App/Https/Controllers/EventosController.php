<?php

namespace App\Https\Controllers;

use Lib\Foxy\Core\Base\Controller;

class EventosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        render("eventos/eventos");
    }
}
