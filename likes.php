<?php
include 'conn.php'; // $mysqli 변수 포함
include "config.php";
session_start();
if(!$userid){
  echo "
    <script>
     alert('로그인 후 이용해 주세요');
     location.href = 'login.php';
    </script>
  ";
}
else if($userid){
$ip = $ip = $_SERVER['REMOTE_ADDR']; // 사용자의 IP주소 가져오기
$article_id = $_POST['articleId']; // 게시글 아이디
$service_code = $_GET['getLikedByCode'];
if(!empty($article_id)) {
    $sql1 = "SELECT * from likes WHERE service_code = 'phpex-$article_id' AND num = '$usernum'";
    $result = mysqli_query($conn,$sql1);
    $result1 = mysqli_num_rows($result); // sql 의 행 갯수를 가져옴 
    if($result1 == 0) {
        // 좋아요 기록이 없는 경우 -> 좋아요 등록
        $sql2 = "INSERT into likes(like_check,idx,nick,liked_ip,service_code,num) VALUES(1,'$article_id','$usernick','$ip','phpex-$article_id','$usernum')";
        $rresult = mysqli_query($conn,$sql2);
        // 게시판 테이블 업데이트
        $sql3 = "UPDATE board SET like_count = like_count + 1 WHERE idx = $article_id";
        $result3 = mysqli_query($conn,$sql3);
        echo $rresult && $result3 ? "like" : "failed"; ?>

   <?php } else {
        // 이미 좋아요를 누른 경우 -> 좋아요 취소
        $sql2 = "DELETE from likes WHERE service_code = 'phpex-$article_id' AND num = '$usernum'";
        $rresult = mysqli_query($conn,$sql2);
        
        // 게시판 테이블 업데이트
        $sql3 = "UPDATE board SET like_count = like_count - 1 WHERE idx = $article_id";
        $result3 = mysqli_query($conn,$sql3);
        echo $rresult && $result3 ? "unlike" : "failed"; ?>
  <?php  }
}
else if(!empty($service_code)){
  $sql1 = "SELECT * from likes WHERE service_code = 'phpex-$article_id' AND num = '$usernum'";
  $result = mysqli_query($conn,$sql1);
  $result1 = mysqli_num_rows($result); // sql 의 행 갯수를 가져옴 
  echo $result1 != 0 ? "liked" : "unliked";
}
}
?>