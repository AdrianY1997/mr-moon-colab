<?php

namespace Lib\Foxy\Core\Base;

use Lib\Foxy\Core\Session;

class Controller
{
    protected $engine;

    public function __construct()
    {
        $GLOBALS["messages"] = Session::getMessage();
    }
}
