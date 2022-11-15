<?php
include "head.html";
include "config.php";
include "conn.php";
?>
<?php 
  session_start();
  if(!$userid){
    echo "
      <script>
       alert('로그인 후 이용해 주세요');
       location.href = 'login.php';
      </script>
    ";
  }
  else if($role=='3'){
    echo "
    <script>
     alert('일반회원만 가능합니다.');
     location.href = 'main.php';
    </script>
  ";
  }
  else{
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="refresh" content="3;url=recommend.php">
  <meta charset="UTF-8">
  <title>로딩중</title>
</head>
<body style="background-color:#f2e5d5;">
<header>
    <?php include "header.php"; ?>
  </header>
<div>
  <div class="d-flex justify-content-center">
  <div class="spinner-border " style="width:250px; height:250px; margin-top:15%;" role="status">
    <span class="visually-hidden">Loading...</span>
  </div>
</div>
<h1 class="text-center center-block" style="margin:8%;"><?=$usernick?> 님을위한 추천 분석을 하고있습니다.</h1>
<footer>
  <div class="fixed-bottom" style=""><?php include "footer.html"; ?></div>
</footer>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <?php }
mysqli_close($conn)
?>
</html>