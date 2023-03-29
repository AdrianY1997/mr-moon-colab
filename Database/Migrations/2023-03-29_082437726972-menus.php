<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("menus", function (Blueprint $table) {
            $table->id();
        });
    }

    public function down()
    {
        Schema::dropIfExists("menus");
    }
};
