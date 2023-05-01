<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Core\Base\Model;

class Reservation extends Model
{
    public function __construct()
    {
        parent::__construct("reservations");
    }
}
