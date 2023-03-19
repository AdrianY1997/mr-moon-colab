<?php

namespace App\Site\Controller;

use Lib\Foxy\Core\Base\Controller;


class MenuController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        render("menu/menu");
    }
}