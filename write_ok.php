<?php
	include "config.php";
	include "conn.php";
	date_default_timezone_set('Asia/Seoul');
	$id = $userid;
	$num = $usernum;
	$nick = $usernick;
	$category = $_POST['category'];
	// $date = date('Y-m-d h:ia');
	$title = $_POST['title'];
	$content = $_POST['content'];
	$photo = $_FILES['uploadfile'];

	// if($_FILES['uploadfile[]'] != NULL){
	// 	$tmp_name = $_FILES['uploadfile[]']['tmp_name'];
	// 	$name = $_FILES['uploadfile[]']['name'];
	// 	$up = move_uploaded_file($tmp_name, "./board_imgs/$name");
	// }





	if($photo != NULL){
		$tmp_name = $photo['tmp_name'];
		$name = $photo['name'];
		$path = "./board_imgs/$usernick";
		$filenames = array();

		if(!file_exists($path)){
				mkdir($path, 0777, true);
				chmod($path, 0777);
				for($i=0; $i<count($name); $i++){
					move_uploaded_file($tmp_name[$i], $path."/".$name[$i]); 
					array_push($filenames, $name[$i]); 
					$arrayString = implode(",", $filenames);
			 }
		}else{
				// $up = move_uploaded_file($tmp_name, "$path/$name");
				for($i=0; $i<count($name); $i++){
					move_uploaded_file($tmp_name[$i], $path."/".$name[$i]);
					array_push($filenames, $name[$i]); 
					$arrayString = implode(",", $filenames);
			 
		}
	}
}
	else{
		$name = "NULL";
	}

// 	$sql = mq("insert into board(name,pw,title,content,date) 
// 			values('".$_POST['name']."','".$userpw."','".$_POST['title']."','".$_POST['content']."','".$date."')"); 
	
	$ai1="alter table board auto_increment =1"; //auto_increment 값 초기화 (삭제 시 번호 비지 않게 하기 위해서)
	$airesult=mysqli_query($conn,$ai1);
	
	if($role=='3'){
			$sql="INSERT into
		board
	SET	
		nick = '".$nick."', 
		c_num = '".$num."', 
		category = '".$category."', 
		title = '".$title."', 
		contents = '".$content."',  
		filename= '".$arrayString."'
	
	";
}
else{

	$sql="INSERT into
			board
		SET	
			nick = '".$nick."', 
			number = '".$num."', 
			category = '".$category."', 
			title = '".$title."', 
			contents = '".$content."',  
			filename= '".$arrayString."'
";
}
	$result = mysqli_query($conn,$sql);
?>
	<script>
		alert("글쓰기 완료되었습니다.");
		location.href = 'board.php';
	</script>
	<?php   
  mysqli_close($conn); ?>

