<?php
    include "conn.php";

    if($_POST['userid'] != NULL){
    $sql = "select * from user where id='{$_POST['userid']}'";
    $result = mysqli_query($conn,$sql);
    $id_check = $result->fetch_array();
    echo $_POST['userid'];
    
    if($id_check >= 1){
      ?><script>
        // $('#id').addClass('is-invalid')
        // $('#id').removeClass('is-valid')
        $("#IDErr").show();
      </script>
      <?php echo "중복된 이메일 입니다.";
    } else {?>
      <script>
        // $('#id').addClass('is-valid')
        // $('#id').removeClass('is-invalid')
        $("#IDErr").hide();
      </script>
      <?php echo "사용가능한 이메일 입니다.";
    }
  } 
?>