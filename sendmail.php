<?php
// $id = trim($_POST['full_id']); // 받는사람 메일주소 
$id=$_POST['id'];
$email=$_POST['email'];
$input_email=$_POST['input_email'];
$full_id=$id.'@'.$email;
echo $full_id;
 // 받는사람 메일주소 
$subject = '메일 인증';
$message = '메일 인증되셨습니다! 아래링크를 클릭하셔서 회원가입을 마무리 해주세요.';
$message?> = <a href">회원가입 완료</a> 

<?php
// html 메일을 보낼 때 꼭 이헤더가 붙어야한다.
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=utf-8';

// Additional headers
//$headers[] = 'To: Kim<받는사람@gmail.com>';
$headers[] = 'From: webmaster<받는사람@gmail.com>';
//$headers[] = 'Cc: Kim1<참조인1@naver.com>,Kim2<참조인2@gmail.com>';
//$headers[] = 'Bcc: 숨은참조인3@gmail.com';


mail($full_id, $subject, $message, implode("\r\n", $headers));
echo "메일을 보냈습니다.";
	echo "<script language=javascript> alert('메일인증성공!'); history.back(); </script>";

?>