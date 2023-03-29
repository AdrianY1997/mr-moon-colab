<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("product_provider", function (Blueprint $table) {
            $table->integer("prod_id")->references("products");
            $table->integer("prov_id")->references("providers");
        });
    }

    public function down()
    {
        Schema::dropIfExists("product_provider");
    }
};
