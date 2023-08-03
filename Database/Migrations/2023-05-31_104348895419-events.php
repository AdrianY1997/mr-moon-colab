<?php

use FoxyMVC\Lib\Foxy\Facades\Schema;
use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;

return new class {
    private string $tableName = "events";

    public function up() {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("path");
            $table->string("text");
            $table->string("fech");
        });

        Schema::insert($this->tableName, [
            "name" => "Bartender Invitado",
            "path" => "img/eventos/bartender.jpg",
            "text" => "En esta exclusiva velada, nuestro talentoso mixólogo compartirá sus conocimientos y técnicas innovadoras mientras prepara bebidas de autor impresionantes. Desde clásicos reinventados hasta creaciones vanguardistas, cada sorbo será una explosión de sabores y creatividad.",
            "fech" => "2023-07-18 11:03:26"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Noche de Karaoke",
            "path" => "img/eventos/Karaoke.jpg",
            "text" => "Ven y únete a la diversión mientras llenamos el escenario con cantantes de todas las edades y talentos. Desde baladas clásicas hasta éxitos actuales, hay algo para cada amante de la música.",
            "fech" => "2023-09-15 05:44:25"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Festividades",
            "path" => "img/eventos/festividades.jpg",
            "text" => "¡Celebremos juntos la magia de la temporada en nuestro espectacular evento de festividades Luces Brillantes y Alegría Festiva!",
            "fech" => "2023-12-24 12:00:00"
        ]);

        Schema::insert($this->tableName, [
            "name" => "Noches de Trivia",
            "path" => "img/eventos/20190820.png",
            "text" => "¡Bienvenidos a nuestra emocionante Noche de Trivia: Desafía tu Conocimiento! Prepárate para poner a prueba tu mente y divertirte con amigos en una noche llena de preguntas intrigantes y respuestas sorprendentes.",
            "fech" => "2023-10-15 03:00:00"
        ]);
    }

    public function down() {
        Schema::dropIfExists($this->tableName);
    }
};