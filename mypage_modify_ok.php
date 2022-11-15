<?php
include "config.php"; 
include "conn.php";

    $uname = $_POST['uname'];
    $nick = $_POST['nick'];
    $phone = $_POST['phone']; 
    $address = $_POST['address']; 
    $address2 = $_POST['address2']; 
    $birthday = $_POST['birthday']; 

$sql = "UPDATE user set uname='".$uname."',nick='".$nick."',phone='".$phone."',address='".$address."',add_detail='".$address2."',birthday='".$birthday."' WHERE id='$userid';";

$result =mysqli_query($conn,$sql);


echo("
  
  <script>
  window.alert('정보가 수정되었습니다!')
    location.href = 'mypage.php';
  </script>");
  
  mysqli_close($conn);
?>
