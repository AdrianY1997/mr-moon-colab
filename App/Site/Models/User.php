<?php

namespace App\Site\Models;

use Lib\Foxy\Core\Base\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct("users");
    }
}
