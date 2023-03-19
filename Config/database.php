<?php

define("DBHOST", getenv("MODE") == "PRO" ? getenv("proDBHOST") : getenv("devDBHOST"));
define("DBUSER", getenv("MODE") == "PRO" ? getenv("proDBUSER") : getenv("devDBUSER"));
define("DBPASS", getenv("MODE") == "PRO" ? getenv("proDBPASS") : getenv("devDBPASS"));
define("DBNAME", getenv("MODE") == "PRO" ? getenv("proDBNAME") : getenv("devDBNAME"));
define("DBPORT", getenv("MODE") == "PRO" ? getenv("proDBPORT") : getenv("devDBPORT"));
define("DBCHST", getenv("MODE") == "PRO" ? getenv("proDBCHST") : getenv("devDBCHST"));