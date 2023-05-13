<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Core\Base\DB;

class __model extends DB {
    public function __construct() {
        parent::__construct("__tableName");
    }
}
