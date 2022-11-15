<?php
	include 'config.php';
	include 'conn.php';


  if(!$userid){
    echo "
      <script>
       alert('로그인 후 이용해 주세요');
       location.href = 'login.php';
      </script>
    ";
  }
  else if($userid){

    date_default_timezone_set('Asia/Seoul');
    $bno = $_POST['bnum'];
    $bnick = $_POST['dat_user'];
    $btext = $_POST['content'];

  if($btext==''){
    echo "
    <script>
     alert('1글자 이상 작성하세요');
     history.back();
    </script>
  ";
  }

  if($role=='3'){ 
    $sql="INSERT into
    reply
  SET	
    idx='".$bno."',
    nick = '".$bnick."', 
    r_content = '".$btext."',  
    c_num = '".$usernum."'
";
  }
  else{
    $sql="INSERT into
    reply
  SET	
    idx='".$bno."',
    nick = '".$bnick."', 
    r_content = '".$btext."',  
    number = '".$usernum."'
";
  }

  $result = mysqli_query($conn,$sql);

  ?>
  
	<script>
		alert("댓글쓰기 완료되었습니다.");
		location.href = 'read.php?idx=<?=$bno?>';
	</script>

  <?php
}
  mysqli_close($conn); 
  ?>