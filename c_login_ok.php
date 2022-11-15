<?php
include "conn.php";

    $id   = $_POST['id'];
    $pass = $_POST['pass']; 
    

  $sql = "SELECT * FROM company WHERE c_id='$id'";
  
  $result = mysqli_query($conn, $sql);

  $num_match = mysqli_num_rows($result);

  if(!$num_match) {
    echo("
          <script>
            window.alert('등록되지 않은 아이디입니다!')
            history.back()
          </script>
        ");
    } else {
        $row = mysqli_fetch_array($result);
        $db_pass = $row['c_pass'];
		
        mysqli_close($conn);
		/* 로그인 화면에서 전송된 $pass와 DB의 $db_pass의 해쉬값 비교 */
        if(!password_verify($pass, $db_pass)){
        	echo("
	              <script>
	                window.alert('비밀번호가 틀립니다!')
	                history.back()
	              </script>
	          ");
	          exit;
        }else {
            session_start();
            $_SESSION["userid"] = $row["c_id"];
            $_SESSION["username"] = $row["c_name"];        
            $_SESSION["usernick"] = $row["c_nick"];        
            $_SESSION["usernum"] = $row["c_num"];       
            $_SESSION["role"] = $row["c_role"];     
            echo("
              <script>
                location.href = 'index.php';
              </script>
            ");
        }
    }       
    mysqli_close($conn); 
?>