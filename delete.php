<?php
	include "conn.php";
	$bno = $_GET['idx'];
	/* 받아온 idx값을 선택해서 게시글 삭제 */
	$sql = "delete from board where idx='$bno'";
  $result = mysqli_query($conn,$sql);

?>
	<script>
		alert("삭제되었습니다.");
    location.href = 'board.php';
	</script>
	<meta http-equiv="refresh" content="0 url=C:/wampp/apache2/htdocs/webproject1/board.php">
