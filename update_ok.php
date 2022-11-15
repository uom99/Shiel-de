<?php
	include "config.php";
	include "conn.php";

	$bno = $_POST['idx']; // $bno(hidden)에 idx값을 받아와 넣음
	$category = $_POST['category'];
	$date = date('Y-m-d H:i:s');
	$title = $_POST['title'];
	$content = $_POST['content'];
	/* 받아온 idx값을 선택해서 게시글 수정 */
	$sql = "update board set date = '".$date."', category='".$category."',title='".$title."',contents='".$content."' where idx='".$bno."'";
  $result = mysqli_query($conn,$sql);


?>
	<script>
		alert("수정되었습니다.");
    location.href = '../read.php?idx=<?=$bno?>'
	</script>
	<?php   
  mysqli_close($conn); ?>

