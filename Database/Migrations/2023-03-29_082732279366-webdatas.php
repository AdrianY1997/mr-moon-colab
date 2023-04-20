<?php

use Lib\Foxy\Database\Schema\Blueprint;
use Lib\Foxy\Facades\Schema;

return new class
{
    public function up()
    {
        Schema::create("webdatas", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("subt");
            $table->string("logo");
            $table->string("email");
            $table->string("phone");
            $table->string("address");
            $table->string("city");
            $table->string("fblink");
            $table->string("twlink");
            $table->string("iglink");
            $table->string("ytlink");
        });

        Schema::insert("webdatas", [
            "id" => 1,
            "name" => "Mr. Moon",
            "subt" => "Coffee & Bar",
            "logo" => "img/static/mr_moon_logo.png",
            "email" => "email@email.com",
            "phone" => "+57 312 334 5555",
            "address" => "Cra 4 No. 4 - 58",
            "city" => "La Plata, Huila",
            "fblink" => "https://facebook.com/",
            "twlink" => "https://twitter.com/",
            "iglink" => "https://instagram.com/",
            "ytlink" => "https://www.youtube.com/"
        ]);
    }

    public function down()
    {
        Schema::dropIfExists("webdata");
    }
};