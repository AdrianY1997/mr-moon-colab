<?php

namespace App\Models;

use Lib\Foxy\Core\Base\Model;

class Code extends Model
{
    public function __construct()
    {
        parent::__construct("codes");
    }
}
