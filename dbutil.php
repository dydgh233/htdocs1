<?php
namespace loginex;

use mysqli;

$HOSTNAME = 'localhost';
$USERNAME = 'webapp';
$PASSWORD = 'webapp';
$DATABASENAME = 'webdb';
// Create a connection DB 커넥션 설정
$dbconn = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASENAME);

if($dbconn) {
    echo "db 연결이 성공하였습닌다.";
} else {
    die("db 연결이 실패하였습니다." .mysqli_connect_error());
}

?>