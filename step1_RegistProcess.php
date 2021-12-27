<?php
//회원가입시 저장버튼 클릭했을 때 동작...
//폼에서 입력받은 username, password를 db에 저장할 것이다.
// Pseudo Code : 처리과정을 일상의 언어로 적어가는 것
/*
 1.post방식으로 전달된 값을 취한다.  $_변수 = $_POST[name];
 2. Form validation 진행
 (전달된 값이 공백이면 다시 값을 입력하라고 요청한다.)
 3.데이터베이스연결
 4.중복체크를 위한 질의 구성
 5.중복체크를 위한 질의실행
 6.1중복계정있으면 중복메세지 출력후 회원가입폼으로 이동
 6.2다음
 7.질의어(insert 구문)를 구성한다
 8.구성된 질의어를 실행시킨다(MySQL에 질의실행 요청.)결과를 돌려받는다.
 9.login 화면으로 이동시킨다.
 */

 //1.
 $username = $_POST['username'];
 $password = $_POST['password'];
 $tel = $_POST['tel'];
 //2.
 if(empty($username)|| empty($password)|| empty($tel)){
     echo("<script>alert('유저명 또는 비밀번호가 공백입니다.');</script>");
     header('Location: step1_RegistForm.php');
 }

 //3.
 $hostname = 'localhost';
 $user = 'webapp';
 $pass= 'webapp';
 $db= 'webdb';

 $dbconn=mysqli_connect($hostname,$user,$pass,$db);
//4.
$sql="SELECT * FROM users WHERE username='".$username."' ";
//5.
$resultset=mysqli_query($dbconn,$sql);

$number=mysqli_num_rows($resultset); //resultset안에 몇개의 레코드가 있는지 숫자로 반환
//6.1
if($number>0){
    header('Location:step1_RegistForm.php');
}else{
   //7.
   
   $sql = "INSERT INTO users(username, userpwd, tel) VALUES('". $username . "','" sha2(".$password.",256) , .$tel. "')";
   
   

   //8.
   $result = mysqli_query($dbconn,$sql);

   //9.
   if($result){
       header('Location:step1_LoginForm.php');
   }
}
?>

