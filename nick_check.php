<?php
    include "conn.php";

    if($_POST['nick'] != NULL){
    $sql = "select * from user where nick='{$_POST['nick']}'";
    $result = mysqli_query($conn,$sql);
    $nick_check = $result->fetch_array();

    if($nick_check >= 1){
      ?><script>
        $("#nickErr").show();
        // $('#nickname').addClass('is-invalid')
        // $('#nickname').removeClass('is-valid')
        // $('#join_btn').attr('disabled',true)
      </script>
      <?php echo "중복된 닉네임 입니다.";
    } else {?>
      <script>
        $("#nickErr").show();
        // $('#nickname').addClass('is-valid')
        // $('#nickname').removeClass('is-invalid')
        // $('#join_btn').attr('disabled',false)
      </script>
      <?php  echo "<font color=green>사용가능한 닉네임 입니다.</font>";
    }
  } 
?>