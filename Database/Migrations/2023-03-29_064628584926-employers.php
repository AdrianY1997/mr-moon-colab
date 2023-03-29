<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("employers", function (Blueprint $table) {
            $table->id();
            $table->string("position");
            $table->integer("user_id");
        });
    }

    public function down()
    {
        Schema::dropIfExists("employers");
    }
};
