<?php

namespace FoxyMVC\App\Models;

use FoxyMVC\Lib\Foxy\Database\Model;
use FoxyMVC\Lib\Foxy\Database\Table;

/**
 * Modelo para los registros
 */
class User extends Table {
    // -- Generated
    public static string $tableName = 'users';
    public Model $model;
    public string $user_id;
    public string $created_at;
    public string $updated_at;
    protected array $hidden = [
        "user_id",
        "created_at",
        "updated_at"
    ];
    // ----

    // -- Here the columns

    public string $user_nick;
    public string $user_email;
    public string $user_pass;
    public string $user_name;
    public string $user_lastname;
    public string $user_address;
    public string $user_phone;
    public string $user_img_path;

    public array $fillable = [
        "user_nick",
        "user_email",
        "user_pass",
        "user_name",
        "user_lastname",
        "user_address",
        "user_phone",
        "user_img_path",
    ];

    // ----
}
