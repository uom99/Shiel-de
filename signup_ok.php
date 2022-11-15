<?php
include "conn.php";

    $uname = $_POST['uname'];
    $nick = $_POST['nick'];
    $id   = $_POST['id'];
    $email   = $_POST['input_email'];
    $email1   = $_POST['email'];
    $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT); 
    $passok = $_POST['passok']; 
    $phone = $_POST['phone']; 
    $address = $_POST['address']; 
    $address2 = $_POST['address2']; 
    $birthday = $_POST['birthday']; 
    
    if(isset($email)){

    $sql = "INSERT INTO user (uname,nick,id,pass,phone,address,add_detail,birthday) values('".$uname."','".$nick."','".$id."@".$email."','".$pass."','".$phone."','".$address."','".$address2."','".$birthday."')";

    }
    else{
    $sql = "INSERT INTO user (uname,nick,id,pass,phone,address,add_detail,birthday) values('".$uname."','".$nick."','".$id."@".$email1."','".$pass."','".$phone."','".$address."','".$address2."','".$birthday."')";
    }
    $result = mysqli_query($conn, $sql);
    echo "
	    <script>
    	    alert('회원가입이 완료 되었습니다.');
	        location.href = 'index.php';
	    </script>
	";

    mysqli_close($conn);

?>