<?php

define('HOST', 'localhost');
define('DBNAME', 'perpustakaan_cl');
define('DBUSER', 'root');
define('DBPASS', '');

$koneksi = mysqli_connect(HOST, DBUSER, DBPASS, DBNAME);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }