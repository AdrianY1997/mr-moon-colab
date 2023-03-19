<?php

namespace App\Models;

use Lib\Foxy\Core\Base\Model;

class Provider extends Model
{
    public function __construct()
    {
        parent::__construct("providers");
    }
}
