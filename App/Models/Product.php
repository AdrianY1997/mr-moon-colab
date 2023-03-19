<?php

namespace App\Models;

use Lib\Foxy\Core\Base\Model;

class Product extends Model
{
    public function __construct()
    {
        parent::__construct("products");
    }
}
