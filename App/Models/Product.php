<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Core\Base\Model;

class Product extends Model
{
    public function __construct()
    {
        parent::__construct("products");
    }
}
