<?php
include "conn.php";

    $uname = $_POST['uname'];
    $nick = $_POST['nick'];
    $bcode = $_POST['bcode'];
    $id   = $_POST['id'];
    $email   = $_POST['input_email'];
    $email1   = $_POST['email'];
    $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT); 
    $passok = $_POST['passok']; 
    $phone = $_POST['phone']; 
    $address = $_POST['address']; 
    $address2 = $_POST['address2']; 

    
    if(isset($email)){

    $sql = "INSERT INTO company (c_name,c_nick,c_id,c_pass,c_bnum,c_tel,c_address,c_add_detail) values('".$uname."','".$nick."','".$id."@".$email."','".$pass."','".$bcode."','".$phone."','".$address."','".$address2."')";

    }
    else{
    $sql = "INSERT INTO company (c_name,c_nick,c_id,c_pass,c_bnum,c_tel,c_address,c_add_detail) values('".$uname."','".$nick."','".$id."@".$email1."','".$pass."','".$bcode."','".$phone."','".$address."','".$address2."')";
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