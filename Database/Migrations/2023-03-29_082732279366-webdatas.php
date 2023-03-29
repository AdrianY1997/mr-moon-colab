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

        Schema::query("INSERT IGNORE INTO webdatas (
            webd_id, webd_name, webd_subt, webd_logo, webd_email, webd_phone, webd_address, webd_city, webd_fblink, webd_twlink, webd_iglink, webd_ytlink
        ) VALUES (
            1, 'Mr. Moon', 'Coffee & Bar', 'img/static/mr_moon_logo.png', 'email@email.com', '+57 312 334 5555', 'Cra 4 No. 4 - 58', 'La Plata, Huila', 'https://facebook.com/', 'https://twitter.com/', 'https://instagram.com/', 'https://www.youtube.com/'
        )");
    }

    public function down()
    {
        Schema::dropIfExists("webdata");
    }
};
