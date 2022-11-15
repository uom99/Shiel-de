<?php

include "conn.php";

$num = $_GET['num'];
$role = $_GET['role'];

if($role == '기업'){

  $sql1 = "delete from company where c_num=$num";
  $sql2 = "delete from board where c_num=$num";
  $sql3 = "delete from reply where c_num=$num";
  // $sql4 = "delete from like where c_num=$num";
}
else{

  $sql1 = "delete from user where number=$num";
  $sql2 = "delete from board where number=$num";
  $sql3 = "delete from reply where number=$num";
  // $sql4 = "delete from like where c_num=$num";

}
$result3 = mysqli_query($conn,$sql3);
$result2 = mysqli_query($conn,$sql2);
$result1 = mysqli_query($conn,$sql1);

mysqli_close($conn);

session_start();
unset($_SESSION["userid"]);
unset($_SESSION["username"]);
unset($_SESSION["userpass"]);
unset($_SESSION["usernick"]);
unset($_SESSION["usernum"]);
unset($_SESSION["role"]);
session_destroy();

?>
<script>
  alert("탈퇴되었습니다.");
  location.href = 'main.php';
</script>