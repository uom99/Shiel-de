<?php
  include "config.php";
  include "conn.php";

  $id = $_POST['id'];
  $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT); 


  if($role=='3'){
  $sql = "UPDATE company set c_pass='".$pass."' where c_id='".$id."'";
}
  else{
    $sql = "UPDATE user set pass='".$pass."' where id='".$id."'";
  }

  $result = mysqli_query($conn, $sql);

?>
<script>
  alert("비밀번호가 변경되었습니다.");
  location.href = 'login.php';
</script>