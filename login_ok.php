<?php
include "conn.php";

    $id   = $_POST['id'];
    $pass = $_POST['pass']; 
    

  $sql = "SELECT * FROM user WHERE id='$id'";
  
  $result = mysqli_query($conn, $sql);

  $num_match = mysqli_num_rows($result);

  if(!$num_match) {
    echo("
          <script>
            alert('등록되지 않은 아이디입니다!');
            history.back();
          </script>
        ");
    } else {
        $row = mysqli_fetch_array($result);
        $db_pass = $row['pass'];
		
        mysqli_close($conn);
		/* 로그인 화면에서 전송된 $pass와 DB의 $db_pass의 해쉬값 비교 */
        if(!password_verify($pass, $db_pass)){
        	echo("
	              <script>
	                alert('비밀번호가 틀립니다!');
	                history.back();
	              </script>
	          ");
	          exit;
        }else {
            session_start();
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["uname"];
            $_SESSION["userpass"] = $row["pass"];        
            $_SESSION["usernick"] = $row["nick"];        
            $_SESSION["usernum"] = $row["number"];        
            $_SESSION["role"] = $row["role"];        
            echo("
              <script>
                location.href = 'index.php';
              </script>
            ");
        }
    }       
    mysqli_close($conn); 
?>