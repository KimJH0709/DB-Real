<?php
   session_start();
   $host = 'localhost';
   $user = 'root';
   $pw = '11111111';
   $db_name = 'stores';
   
   $mysqli = new mysqli($host, $user, $pw, $db_name); //db 연결
      
   //login.php에서 입력받은 id, password
   $user_id = $_POST['user_id'];
   $user_pw = $_POST['user_pw'];
      
   $q = "SELECT * FROM user WHERE user_id = '$user_id' AND user_pw = '$user_pw'";
   $result = $mysqli->query($q);
   $row = $result->fetch_array(MYSQLI_ASSOC);
      
   //결과가 존재하면 세션 생성
   if ($row != null) {
      $_SESSION['user_id'] = $row['ID']; 
      if($row['user_admin'] == 1) {
         echo "<script>location.replace('admin.php');</script>";
         exit;
      } else{ 
         echo "<script>location.replace('main.php');</script>";
         exit;
      }
   }
      
   //결과가 존재하지 않으면 로그인 실패
   if($row == null){
      echo "<script>alert('유효하지 않는 아이디 또는 비밀번호가 틀렸습니다.')</script>";
      echo "<script>location.replace('login.php');</script>";
      exit;
   }
?>