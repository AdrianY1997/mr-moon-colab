<?php

namespace App\Models;

use Lib\Foxy\Core\Base\Model;

class Employer extends Model
{
    public function __construct()
    {
        parent::__construct("employers");
    }
}
