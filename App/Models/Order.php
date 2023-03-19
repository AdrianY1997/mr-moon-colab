<?php

namespace App\Models;

use Lib\Foxy\Core\Base\Model;

class Order extends Model
{
    public function __construct()
    {
        parent::__construct("orders");
    }
}
