<?php

namespace App\Models;

use Lib\Foxy\Core\Base\Model;

class Menu extends Model
{
    public function __construct()
    {
        parent::__construct("menus");
    }
}
