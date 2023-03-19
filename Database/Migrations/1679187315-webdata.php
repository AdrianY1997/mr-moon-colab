<?php

return new class
{
    protected $tableName = "webdatas";

    public function up()
    {
        $tableName = $this->tableName;

        return "CREATE TABLE IF NOT EXISTS $tableName (
            webd_id INT AUTO_INCREMENT,
            webd_name VARCHAR(255),
            webd_subt VARCHAR(255),
            webd_logo VARCHAR(255),
            webd_email VARCHAR(255),
            webd_phone VARCHAR(255),
            webd_address VARCHAR(255),
            webd_city VARCHAR(255),
            webd_fblink VARCHAR(255),
            webd_twlink VARCHAR(255),
            webd_iglink VARCHAR(255),
            webd_ytlink VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (webd_id)
        );
        
        INSERT IGNORE INTO webdatas (
            webd_id, webd_name, webd_subt, webd_logo, webd_email, webd_phone, webd_address, webd_city, webd_fblink, webd_twlink, webd_iglink, webd_ytlink
        ) VALUES (
            1, 'Mr. Moon', 'Coffee & Bar', 'img/static/mr_moon_logo.png', 'email@email.com', '+57 312 334 5555', 'Cra 4 No. 4 - 58', 'La Plata, Huila', 'https://facebook.com/', 'https://twitter.com/', 'https://instagram.com/', 'https://www.youtube.com/'
        )";
    }

    public function down()
    {
        $tableName = $this->tableName;

        return "DROP TABLE IF EXISTS $tableName;";
    }
};
