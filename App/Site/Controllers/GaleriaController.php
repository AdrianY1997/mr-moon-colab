<?php

namespace App\Site\Controllers;

use Lib\Foxy\Core\Base\Controller;


class GaleriaController extends Controller
{
   public function __construct()
   {
      parent::__construct();
   }

   function index()
   {
      render("galeria/galeria");
   }
}
