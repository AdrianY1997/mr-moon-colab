<?php

if (getenv("MODE") == "DEV") {
    define("DBHOST", getenv("devDBHOST"));
    define("DBUSER", getenv("devDBUSER"));
    define("DBPASS", getenv("devDBPASS"));
    define("DBNAME", getenv("devDBNAME"));
    define("DBPORT", getenv("devDBPORT"));
    define("DBCHST", getenv("devDBCHST"));
} else {
    define("DBHOST", getenv("proDBHOST"));
    define("DBUSER", getenv("proDBUSER"));
    define("DBPASS", getenv("proDBPASS"));
    define("DBNAME", getenv("proDBNAME"));
    define("DBPORT", getenv("proDBPORT"));
    define("DBCHST", getenv("proDBCHST"));
}

define("DPFILE", getenv("DPFILE"));
define("DBFILE", getenv("DBFILE"));
