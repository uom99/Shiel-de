<style>
                  .btn-like .heart-shape {
                    display: inline;
                    color: red;}
                  .btn-like {
                    border: none;
                    background-color: inherit;}
                </style>

<?php

	include_once "config.php";
	include "conn.php";

  $name = $_FILES['uploadfile']['name'];
  $path = "./board_imgs/$usernick";

	$bno = $_GET['idx']; // $bno에 idx값을 받아와 넣음 
	/* 조회수 올리기  */
  $sql1 = "select * from board where idx ='".$bno."'";
  $result1 = mysqli_query($conn,$sql1);
	$hit = mysqli_fetch_array($result1);
	$hit = $hit['hit'] + 1;
  // $hit = intval($hit);
	$sql2 = "update board set hit='".$hit."' where idx='".$bno."' ";
  $result2 = mysqli_query($conn,$sql2);

	/* 조회수 올리기 끝 */
	
	/* 받아온 idx값을 선택해서 게시글 정보 가져오기 */
	$sql3 = "select * from board where idx='".$bno."'";
  $result3 = mysqli_query($conn,$sql3); 
	$board = mysqli_fetch_array($result3);
  /*보드 좋아요 */
  $sql4 = "select * from board where idx='".$bno."'";
  $result4 = mysqli_query($conn,$sql4); 
  /*좋아요 하트 */
  $sqli = "select * from likes where idx='$board[idx]'";
  $resulti = mysqli_query($conn,$sqli);
  $likes = mysqli_fetch_array($resulti);
  /* 댓글 개수 구하기*/
  $sql5 = "select * from reply where idx='".$bno."'";
  $result5 = mysqli_query($conn,$sql5);
  $rep_count = mysqli_num_rows($result5);
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once "head.html";?>

</head>

<body>
  <!-- 표준 네비게이션 바 (화면 상단에 위치, 화면에 의존하여 확대 및 축소) -->
  <nav class="navbar navbar-default">
    <?php include_once "header.php";?>
  </nav>
  <div class="container mt-5 pt-4">
    <!-- 글 불러오기 -->
    <div id="board_read">
      <table class="table table-striped" style=" border: 1px solid #ddddda">
        <thead>
          <tr>
            <th colspan="7" style="background-color: #eeeeee;">
              <div class="d-flex">
                <h3>[<?=$board['category']?>]</h3> &ensp; <h4 class="mt-2 fs-5"><?=$board['title']?></h4>
              </div>
            </th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="5">작성자 : <?=$board['nick']?><span style="float:right">작성일자 : <?=$board['date']?></span></td>
          </tr>
          <tr>
          <td colspan="5" style="min-height: 200px; text-align: left;">첨부파일 : <a href="./board_imgs/<?=$board['nick']?>/<?=$board['filename']?>" target="_blank"><?=$board['filename']?></td></a>
          </tr>
<tr>
<?php while($board2 = mysqli_fetch_array($result4)) { 
        $idx = $board2['idx']; 
        if($likes['like_check']==1){; ?>
        <td class="like-container">추천 : <button type="button" class="btn-like" data-article-id="'<?=$idx;?>'"  onclick="location.href='likes.php?articleId=<?=$idx;?>'">
          <span class="heart-shape">♥</span> <span class="like-count"><?=$board2['like_count']?></span></button></td>
       <?php }else{; ?>
                <td class="like-container">추천 : <button type="button" class="btn-like" data-article-id="'<?=$idx;?>'"  onclick="location.href='likes.php?articleId=<?=$idx;?>'">
                <span class="heart-shape">♡</span> <span class="like-count"><?=$board2['like_count']?></span></button></td>
         <?php ;}}?>
</tr>
          <tr>
            <td colspan="2" style="min-height: 200px; text-align: left;"><?=$board['contents']?><br>
            <?php 
            if($board['filename']){ 
              $photoArr = explode(",",$board['filename']);
              for($i=0; $i<count($photoArr); $i++){ ?>
            <img style="" src="./board_imgs/<?=$board['nick']?>/<?=$photoArr[$i]?>" alt="업로드이미지">
          
            <?php } ?>
            </td>
              <?php } ?>
          </tr>
        </tbody>
      </table>
      <!-- 목록, 수정, 삭제 -->
      <div class="float-end">
        <a href="board.php" class="btn btn-light btn-outline-secondary">목록</a>
        <!-- 자신의 글만 수정, 삭제 할 수 있도록 설정-->
        <?php 
					if($usernick==$board['nick'] || $role=="1"){ // 본인 아이디거나, 관리자 계정이거나
				?>
        <a href="update.php?idx=<?=$board['idx']?>" class="btn btn-primary">수정</a>
        <a href="delete.php?idx=<?=$board['idx']?>" class="btn btn-primary">삭제</a>
      </div>
      <?php } ?>
    </div>
  </div>
  <!-- 댓글 불러오기 -->
  <div class="container">
    <div class="reply_view">
      <h4 style="padding:10px 0 15px 0; border-bottom: solid 1px gray;">댓글목록</h4>
      <?php 
					$sql4="select * from reply where idx='".$bno."' order by idx desc";
          $result4 = mysqli_query($conn,$sql4);
					?>
					<table class="table table-bordered">
					<?php
					while($reply=mysqli_fetch_array($result4)){
				?>
           
        <tr>
          <th><?=$reply['nick']?></th>
          <td ><?=$reply['r_content']?><button type="button" class="btn float-end"
              onclick="location.href='reply_delete.php?ridx=<?=$reply['r_idx']?>&idx=<?=$bno;?>'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
</svg></button><p class="float-end"><?=$reply['r_date']?>&nbsp;</p></td>
        </tr>
     

      <?php } ?>
			</table>
      <!-- 댓글 달기 -->
      <div class="dat_ins border">
        <div class="p-3">
          <form action="reply_ok.php" method="post">

            <input type="hidden" name="bnum" class="form-control bno" value=<?=$bno?>>
            <input type="hidden" name="dat_user" id="dat_user" class="form-control dat_user" value=<?=$usernick?>>

            <div class="row">
              <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10" >
                <textarea type="textarea" name="content" class="form-control rep_con" id="rep_con" required> </textarea>
              </div>
              <div class="col-lg-1 col-md-2 col-sm-2 col-xs-10">
                <button id="rep_btn" class="btn btn-sm btn-light btn-outline-dark rep_btn mt-4" type="submit">댓글</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- 댓글 불러오기 끝 -->
  <script src="./js/jquery-3.6.1.min.js"></script>
  <script src="./js/login.js"></script>
  <script src="./js/event.js"></script>
  <script src="./js/like.js"></script>

</body>

</html>