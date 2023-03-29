<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("providers", function (Blueprint $table) {
            $table->id();
            $table->string("nit")->unique();
            $table->string("name");
            $table->string("email");
            $table->string("phone");
        });
    }

    public function down()
    {
        Schema::dropIfExists("providers");
    }
};
