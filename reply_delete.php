<?php
	include 'config.php';
	include 'conn.php';
	

	$rno = $_GET['ridx']; 
	$role = $_SESSION['role'];
	$sql = "select * from reply where r_idx='".$rno."'";
  $result = mysqli_query($conn,$sql);
	$reply = mysqli_fetch_array($result);
		// hidden의 값 b_no를 받아와 그 값에 해당하는 idx 에 대한 board 정보 가져오기
	$bno = $_GET['idx'];
	$sql2 = "select * from board where idx='".$bno."'";
  $result2 = mysqli_query($conn,$sql2);
	$board = mysqli_fetch_array($result2);

	if($role=="0" || $role=="3") {
		/* 비밀번호를 db의 해쉬값과 비교,  세션값과 db의 name을 비교  */
		if($usernick == $reply['nick'])
		{
			// 테이블 reply에서 인덱스값이 $rno인 값을 찾아 삭제
			$sql = "delete from reply where r_idx='".$rno."'";
      $result = mysqli_query($conn, $sql);
			?>
					<script>
						alert("댓글이 삭제 되었습니다.");
						location.href='read.php?idx=<?=$bno?>';
					</script>
					<!-- <meta http-equiv="refresh" content="0 url=/webproject1/read.php?idx=<?=$bno?>"> -->
		
				<?php 
			}else{ ?>
					<script>
						alert('본인의 댓글이 아닙니다');
						history.back();
					</script>
		<?php } ?>
	<?php 
	} else if($role=="1") { 
				// 테이블 reply에서 인덱스값이 $rno인 값을 찾아 삭제
				$sql = "delete from reply where r_idx='".$rno."'";
        $result = mysqli_query($conn, $sql);
 
				?>
					<script>
						alert("댓글이 삭제 되었습니다.");
						location.href='read.php?idx=<?=$bno?>';
					</script>
					<!-- <meta http-equiv="refresh" content="0 url=/webproject1/read.php?idx=<?=$bno?>"> -->
		
		<?php } ?>
	
