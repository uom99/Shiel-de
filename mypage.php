<?php include_once "config.php" ?>
<?php include "conn.php"; ?>
<?php 
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "head.html"?>
</head>

<body class="" style="background-color:#aca193">
  <header>
    <?php include_once "header.php" ?>
  </header>
  <?php 
  	if (isset($_GET["page"]))
		$page = $_GET["page"]; //1,2,3,4,5
	  else
		$page = 1;


			    	
    $mp_sql="SELECT * FROM user WHERE id='$userid'";
    $result = mysqli_query($conn,$mp_sql);
    $mp_user = mysqli_fetch_array($result);







?>


  <main class="container mt-5 pt-5">
    <div class="d-flex align-items-center p-3 my-3 bg-white rounded shadow-sm">
      <div class="lh-1 text-center">
        <h1 class="h6 mb-0 text-black lh-1 text-center">MY PAGE</h1>
      </div>
      <div class="ms-auto">
        <div style="position:fixed" class=" mt-5">
          <div class="collapse float-none" id="collapseExample" style="">
            <div class="card card-body">
              <small class="d-block text-first">
                <a class="btn btn-sm btn-link" href="mypage_modify.php">내 정보 수정</a>
              </small>
              <small class="d-block text-first">
                <a class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">회원탈퇴</a>
              </small>
            </div>
          </div>
        </div>
        <p class="ms-auto">
          <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
            aria-expanded="false" aria-controls="collapseExample">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
              class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
              <path
                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
            </svg>
          </button>
        </p>
      </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">회원탈퇴</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        정말 탈퇴하시겠습니까?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
        <button type="button" class="btn btn-danger" onclick="location.href='member_withdrawal.php?num=<?=$usernum;?>&role=<?=$role;?>'">탈퇴</button>
      </div>
    </div>
  </div>
</div>

    <hr class="p-0 m-0 border-0">


    
    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="border-bottom pb-2 mb-0">내 활동</h6>
      <div class="d-flex border-bottom">
        <div class="vr"></div>
        <div class="d-flex text-muted pt-3 w-100 mx-auto">
          <div class="pb-3 mb-0 small lh-sm w-100 h-100">
            <div class="d-flex justify-content-between">
              <div class="btn-group w-100" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check write_ck " value="myboard" name="mywrite" id="mywrite1"
                  autocomplete="off" type='myboard' type='hidden' onclick="location.href='mypage.php'" checked >
                <label class="btn btn-outline-dark w-25" for="mywrite1">내가 쓴 글</label>

                <input type="radio" class="btn-check write_ck " value="myreply" name="mywrite" id="mywrite2"
                  autocomplete="off" type='myreply' type='hidden' onclick="location.href='mypage_reply.php'" >
                <label class="btn btn-outline-dark w-25" for="mywrite2">댓글 단 글</label>

                <input type="radio" class="btn-check write_ck" value="mylikes" name="mywrite" id="mywrite3"
                  autocomplete="off" type='mylikes' type='hidden' onclick="location.href='mypage_likes.php'">
                <label class="btn btn-outline-dark w-25" for="mywrite3">좋아요 한 글</label>
              </div>

            </div>
            <?php $type=$_GET['type']; ?>
          
            <div class="myboard">
              <table class="table table-hover mt-1" style="border: 1px solid #ddddda">
                <tr>
                  <th style="background-color: #ddffff; text-align: center;">번호</th>
                  <th style="background-color: #ddffff;">카테고리</th>
                  <th style="background-color: #ddffff;">제목</th>
                  <th style="background-color: #ddffff; text-align: center;">작성일</th>
                  <th style="background-color: #ddffff; text-align: center;">조회수</th>
                  <th style="background-color: #ddffff; text-align: center;">추천</th>
                </tr>
                <?php
                    $sql = "select * from board where number='$usernum';";
                    $result = mysqli_query($conn,$sql);
                    $total_record =  mysqli_num_rows($result); // 게시판 총 레코드 수z
                    $list = 10; // 한 페이지에 보여줄 개수
                    $block_cnt = 5; // 블록당 보여줄 페이지 개수
                    $block_num = ceil($page / $block_cnt); // 현재 페이지 블록 구하기
                    $block_start = (($block_num - 1) * $block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
                    $block_end = $block_start + $block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...
                    
                    
                    $total_page = ceil($total_record / $list); // 페이징한 페이지 수
                    if($block_end > $total_page){ // 블록의 마지막 번호가 페이지 수 보다 많다면
                      $block_end = $total_page; // 마지막 번호는 페이지 수
                    }
                    $total_block = ceil($total_page / $block_cnt); // 블럭 총 개수
                    $page_start = ($page - 1) * $list; // 페이지 시작
                
    $b_sql = "SELECT * FROM board where number='$usernum' order by idx desc limit $page_start, $list;";
    $b_result = mysqli_query($conn,$b_sql);

              while($board = mysqli_fetch_array($b_result)){
                $title = $board["title"];
                if(strlen($title)>30){
                  $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                }
                                  
                $sql5 = "select * from reply where idx='".$board['idx']."'";
                $result5 = mysqli_query($conn,$sql5);
                $rep_count = mysqli_num_rows($result5);
                ?>
                <tr class="read_check" style="cursor:pointer" data-action="read.php?idx=<?=$board['idx']?>">
                  <td style="text-align : center" width="70"><?=$board['idx'];?></td>
                  <td width="150"><?=$board['category']?></td>
                  <td width="300"><?=$title?><span class="text-danger" style="font-size:14px"> [<?= $rep_count?>]</span>
                  </td>
                  <td style="text-align : center" width="200"><?=$board['date'];?></td>
                  <td style="text-align : center" width="110"><?=$board['hit']; ?></td>
                  <td style="text-align : center" width="110"><?=$board['like_count']?></td>
                </tr>

                <?php

              }
              ?>
              </table>
              <div id="page_num" class="mx-auto center" style="text-align: center;">
            <ul class="pagination justify-content-center">
              <?php
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		echo "<li class='page-item'><a class='page-link' href='mypage.php?page=1&type=myboard'> &laquo; </a></li>";
				    	}
				    	
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		$pre = $page - 1;
				    		echo "<li class='page-item'><a class='page-link' href='mypage.php?page=$pre&type=myboard'> < </a></li>";
				    		
				    	}
				    	
				    	for($i = $block_start; $i <= $block_end; $i++){
				    		if($page == $i){
				    			echo "<li class='page-item active'><a class='page-link' href='mypage.php?page=$i&type=myboard'> $i </a></li>";
				    		} else {
				    			echo "<li class='page-item'><a class='page-link' href='mypage.php?page=$i&type=myboard'> $i </a></li>";
				    		}
				    	}
				    	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		$next = $page + 1;
				    		echo "<li class='page-item'><a class='page-link' href='mypage.php?page=$next&type=myboard'> > </a></li>";
				    	}
					   	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		echo "<li class='page-item'><a class='page-link' href='mypage.php?page=$total_page&type=myboard'> &raquo; </a></li>";
				    	}
					?>
            </ul>
          </div>
            </div>

            </div>

          </div>


        </div>


      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="./js/jquery-3.6.1.min.js"></script>
  <script src="./js/mypage.js"></script>
  <script>
  <!-- 일반 글 클릭시 해당 idx의 read 페이지로 이동하는 이벤트 
  -->
  $(function()
  {
  $(".read_check").click(function()
  {
  var
  action_url
  =
  $(this).attr("data-action");
  console.log(action_url);
  $(location).attr("href",action_url);
  });
  });
  </script>



</body>

</html>
<?php }
mysqli_close($conn)
?>