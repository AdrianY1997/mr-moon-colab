<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Core\Base\Model;

class Role extends Model
{
    public function __construct()
    {
        parent::__construct("roles");
    }
}
