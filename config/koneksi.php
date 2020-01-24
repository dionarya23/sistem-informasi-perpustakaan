<?php

define('HOST', 'localhost');
define('DBNAME', 'perpust2_perpustakaan');
define('DBUSER', 'perpust2_perpustakaan');
define('DBPASS', 'd10n4ry4pamungkas');

$koneksi = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }