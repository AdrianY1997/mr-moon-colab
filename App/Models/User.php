<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Core\Base\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct("users");
    }
}
