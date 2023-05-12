<?php 

define('DB_USER', 'xUser');
define('DB_PASS', 'xusr789');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'testdb');
define('LOGIN_TBL', 'tbl_teacher');


$db_con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
