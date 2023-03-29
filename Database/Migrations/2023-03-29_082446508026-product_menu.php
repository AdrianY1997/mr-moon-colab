<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("product_menu", function (Blueprint $table) {
            $table->integer("prod_id")->references("products");
            $table->integer("menu_id")->references("menus");
        });
    }

    public function down()
    {
        Schema::dropIfExists("product_menu");
    }
};
