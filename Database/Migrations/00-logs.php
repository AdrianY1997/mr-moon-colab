<?php

use FoxyMVC\Lib\Foxy\Database\Schema\Blueprint;
use FoxyMVC\Lib\Foxy\Facades\Schema;

/**
 * Clase para crear y eliminar la tabla de registros
 */
return new class {
    /**
     * Crea la tabla de registros
     */
    public function up() {
        Schema::create("logs", function (Blueprint $table) {
            $table->id();
            $table->string("tableName");
            $table->string("params");
            $table->string("action");
        });
    }

    /**
     * Elimina la tabla de registros
     */
    public function down() {
        Schema::dropIfExists("logs");
    }
};
