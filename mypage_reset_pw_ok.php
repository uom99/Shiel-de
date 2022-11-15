<?php
  include "config.php";
  include "conn.php";
  include "pw_change.php";
  

  $id = $_POST['id'];
  $pass =$_POST['nowpass'];
  $dbpass = $userpw['pass'];
  $cgpass = password_hash($_POST['pass'],PASSWORD_DEFAULT); 
  
if(password_verify($pass, $dbpass)){
  if($role=='3'){

  $sql = "UPDATE company set c_pass='".$cgpass."' where c_id='".$id."'"; 
}
  else{
    $sql = "UPDATE user set pass='".$cgpass."' where id='".$id."'"; 
}?>
      <script>
      alert("비밀번호가 변경되었습니다.");
      location.href = 'logout.php';
    </script>
    <?php
}
else{?>
<script>
alert("현재 비밀번호가 일치하지 않습니다. <?=$sql?>");
</script>

<?php ;}?>
<?php
  $result = mysqli_query($conn, $sql);

?>
