<?php

namespace App\Site\Controller;

use Lib\Foxy\Core\Base\Controller;


class ReservasController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        render("reservas/reservas");
    }
}
