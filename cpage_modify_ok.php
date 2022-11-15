<?php
include "config.php"; 
include "conn.php";

    $uname = $_POST['uname'];
    $nick = $_POST['nick'];
    $phone = $_POST['phone']; 
    $address = $_POST['address']; 
    $address2 = $_POST['address2']; 


$sql = "UPDATE company set c_name='".$uname."',c_nick='".$nick."',c_tel='".$phone."',c_address='".$address."',c_add_detail='".$address2."' WHERE c_id='$userid';";

$result =mysqli_query($conn,$sql);


echo("
  
  <script>
  window.alert('정보가 수정되었습니다!')
    location.href = 'cpage.php';
  </script>");
  
  mysqli_close($conn);
?>
