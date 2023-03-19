<?php

namespace App\Site\Models;

use Lib\Foxy\Core\Base\Model;

class Bill extends Model
{
    public function __construct()
    {
        parent::__construct("bills");
    }
}
