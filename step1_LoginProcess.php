<?php
// Pseudo Code : 처리과정을 일상의 언어로 적어가는 것
/*
 1.post방식으로 전달된 값을 취한다.  $_변수 = $_POST[name];
 2. Form validation 진행
 (전달된 값이 공백이면 다시 값을 입력하라고 요청한다.)
 3.질의어를 구성한다
 4.구성된 질의어를 실행시킨다(MySQL에 질의실행 요청.)
 5.실행 결과를 돌려받는다
 6.결과를 확인하고..... 레코드가 존재하면 로그인성공  페이지로이동
 6.2                           존재하지않으면 로그인 실패.. 폼화면으로 이동
 
 
 */

 //1.
 $username = $_POST['username'];
 $password = $_POST['password'];

 //2.
 //사용자명 또는 비밀번호 중 하나라도 입력하지 않았으면
 //다시 로그인폼화면으로 이동
 if(empty($username)|| empty($password)){
     echo "<script>alert('사용자명 또는 비밀번호를 확인해주세요.');</script>";
     header('Location:step1_LoginForm.php');
 }
//3.1 데이터베이스 연결
$host='localhost';
$user = 'webapp';
$pass = 'webapp';
$db = 'webdb';
// $dbconn = mysqli_connect(호스트명,사용자명,비밀번호,데이터베이스);
$dbconn = mysqli_connect($host,$user,$pass,$db);
if(is_null($dbconn)){
    echo "데이터베이스 연결에 문제가 있습니다.";
}
//4 SQL 구성

$sql = "SELECT userpwd FROM users WHERE username='".$username."'";
$sql = "SELECT * FROM users
WHERE userpwd = sha2('user5',256)";

//5. 실행하고 결과확인
$resultset=mysqli_query($dbconn,$sql);

while($row = mysqli_fetch_array($resultset)){
    if($password==$row['userpwd']){
        header('Location:step1_LoginSuccess.php');
    }else{
        echo'비밀번호가 틀렸습니다.';
        header('Location:step1_LoginForm.php');
    }
}




?>