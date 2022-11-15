<?php
  include "conn.php";

  $num = $_GET['num'];
  $name = $_GET['name'];
  $nick = $_GET['nick'];
  $id = $_GET['id'];
  $tel = $_GET['tel'];
  $add = $_GET['add'];
  $role = $_GET['role'];
  $bnum = $_GET['bnum'];

  if($role=='기업'){
    $role = 3;
    $sql1 = "UPDATE company set c_name='".$name."',c_nick='".$nick."',c_id='".$id."',c_tel='".$tel."',c_role='".$role."',c_bnum='".$bnum."' WHERE c_num='$num';";

    $sql2 = "UPDATE board set c_num='".$num."', c_nick='".$nick."' where c_num='".$num."';";
    $sql3 = "UPDATE reply set c_num='".$num."', nick='".$nick."' where c_num='".$num."';";
    $sql4 = "UPDATE likes set num='".$num."', nick='".$nick."' where num='".$num."';";
  }
  else{
    if($role == '일반'){
      $role = 0;
    }
    else{
      $role = 1;
    }
    $sql1 = "UPDATE user set uname='".$name."',nick='".$nick."',id='".$id."',phone='".$tel."',role='".$role."' WHERE number='$num';";

    $sql2 = "UPDATE board set number='".$num."', nick='".$nick."' where number='".$num."';";
    $sql3 = "UPDATE reply set number='".$num."', nick='".$nick."' where number='".$num."';";
    $sql4 = "UPDATE likes set num='".$num."', nick='".$nick."' where num='".$num."';";
  }

  echo $sql1.'<br>';
  echo $sql2.'<br>';
  echo $sql3.'<br>';
  echo $sql4.'<br>';
  
  $result1 = mysqli_query($conn,$sql1);
  $result2 = mysqli_query($conn,$sql2);
  $result3 = mysqli_query($conn,$sql3);
  $result4 = mysqli_query($conn,$sql4);

?>

<script>
    alert('정보가 수정되었습니다!')
    location.href = 'member.php';
</script>