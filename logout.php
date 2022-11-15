<?php
  session_start();
  unset($_SESSION["userid"]);
  unset($_SESSION["username"]);
  session_destroy();
  echo("
       <script>
  		  alert('로그아웃 했습니다.');
          location.href = 'index.php';
         </script>
       ");
?>
