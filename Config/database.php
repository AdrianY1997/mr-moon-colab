<?php

define("DBHOST", getenv("MODE") == "DEV" ? getenv("devDBHOST") : getenv("proDBHOST"));
define("DBUSER", getenv("MODE") == "DEV" ? getenv("devDBUSER") : getenv("proDBUSER"));
define("DBPASS", getenv("MODE") == "DEV" ? getenv("devDBPASS") : getenv("proDBPASS"));
define("DBNAME", getenv("MODE") == "DEV" ? getenv("devDBNAME") : getenv("proDBNAME"));
define("DBPORT", getenv("MODE") == "DEV" ? getenv("devDBPORT") : getenv("proDBPORT"));
define("DBCHST", getenv("MODE") == "DEV" ? getenv("devDBCHST") : getenv("proDBCHST"));

define("DPFILE", getenv("DPFILE"));
