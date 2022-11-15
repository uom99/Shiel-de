<?php 
	include_once "config.php";
	// global $con;
 	include "conn.php";
	// 현재 페이지 번호를 확인
	if (isset($_GET["page"]))
		$page = $_GET["page"]; //1,2,3,4,5
	else
		$page = 1;
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once "head.html";
		?>
  <script src="js/board.js" defer></script>
  <style>

.btn-like .heart-shape {
    display: inline;
    color: red;
}
.btn-like {
    border: none;
    background-color: inherit;
}
/* .btn-like {
    display: none;
    border: none;
    background-color: inherit;
} */
  </style>
</head>

<body>
  <!-- 표준 네비게이션 바 (화면 상단에 위치, 화면에 의존하여 확대 및 축소) -->
  <header>
    <?php include_once "header.php";?>
  </header>
  
  <main id="fullpage">
    <div class="section">
      <div class="container w-100 h-100 mt-5 pt-2">
        <div id="board_area"> <br>
          <!-- <div class="nav w-100 dropdown">
					<a href="#" data-bs-toggle="dropdown" role="button" class="fs-5 btn btn-dark w-100 dropdown-toggle">전체게시판</a>
            <ul class="blist w-100 dropdown-menu dropdown-menu-dark">
                  <li class="category"><a class="dropdown-item btn fs-5 " role="button" href="#">공지사항</a></li>
                  <li class="category"><a class="dropdown-item btn fs-5 " role="button" href="#">업체공지</a></li>
                  <li class="category"><a class="dropdown-item btn fs-5 " role="button" href="#">리뷰</a></li>
                  <li class="category"><a class="dropdown-item btn fs-5 " role="button" href="#">질문</a></li>
                  <li class="category"><a class="dropdown-item btn fs-5 " role="button" href="#">일상</a></li>
                  <li class="category"><a class="dropdown-item btn fs-5 " role="button" href="#">유머</a></li>
                  <li class="category"><a class="dropdown-item btn fs-5 " role="button" href="#">자유</a></li>                
              
            </ul>
          </div> -->
          <select class="nav w-100  form-select">
                  <option class="category">전체게시판</option>
                  <option class="category">공지사항</option>
                  <option class="category">업체공지</option>
                  <option class="category">리뷰</option>
                  <option class="category">질문</option>
                  <option class="category">일상</option>
                  <option class="category">유머</option>
                  <option class="category">자유</option>                
          </select>

          <table class="table table-hover" style="text-align: center; border: 1px solid #ddddda">
            <tr>
              <th style="background-color: #ffffdd; text-align: center;">번호</th>
              <th style="background-color: #ffffdd; text-align: center;">말머리</th>
              <th style="background-color: #ffffdd; text-align: center;">제목</th>
              <th style="background-color: #ffffdd; text-align: center;">작성자</th>
              <th style="background-color: #ffffdd; text-align: center;">작성일</th>
              <th style="background-color: #ffffdd; text-align: center;">조회수</th>
              <th style="background-color: #ffffdd; text-align: center;">좋아요</th>
            </tr>

            <!-- 페이징 구현 -->
            <?php 
			    	$sql = "SELECT * from board";
					$result = mysqli_query($conn,$sql);
			    	$total_record = mysqli_num_rows($result); // 게시판 총 레코드 수z
			  		
			    	$list = 5; // 한 페이지에 보여줄 개수
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
			    	
			    	/* 게시글 정보 가져오기  limit : (시작번호, 보여질 수) */
			    	$sql2 = "SELECT * from board order by idx desc limit $page_start, $list";
						$result2 = mysqli_query($conn,$sql2); 
			    	while($board = $result2->fetch_array()){
			    		$title=$board["title"];
			    		/* 글자수가 30이 넘으면 ... 처리해주기 */
			    		if(strlen($title)>30){
			    			$title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
			    		}
			    
			    		/* 댓글 수 구하기 */
			    		// $sql3 = "SELECT * from reply where con_num='".$board['idx']."'";
							// $result3 = mysqli_query($conn,$sql3);
			    		// $rep_count = mysqli_num_rows($result3); // 레코드의 수(댓글의 수)
			    					  
			    ?>

            <!-- 글 목록 가져오기 -->
            
              <tr>
                <td width="70"><?=$board['idx']; ?></td>
								<td width="150"><?=$board['category']?></td>
                <td width="300">
                  <!--  글 가져오기 -->

                  <span class="read_check" style="cursor:pointer"
                    data-action="read.php?idx=<?=$board['idx']?>"><?=$title?></span>
                  <!-- <span style="color:blue;">[<?=$rep_count?>]</span> -->
                </td>
                <td width="120"><?=$board['nick']?></td>
                <td width="200"><?=$board['date'];?></td>
                <td width="110"><?=$board['hit']; ?></td>
                <td width="110"><?=$board['like_count']?></td>
              </tr>
            
            <?php } ?>
          </table>
          <div id="page_num" style="text-align: center;">
            <?php
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		echo "<a href='list.php?page=1'>처음</a>";
				    	}
				    	
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		$pre = $page - 1;
				    		echo "<a href='list.php?page=$pre'>◀ 이전 </a>";
				    		
				    	}
				    	
				    	for($i = $block_start; $i <= $block_end; $i++){
				    		if($page == $i){
				    			echo "<b> $i </b>";
				    		} else {
				    			echo "<a href='list.php?page=$i'> $i </a>";
				    		}
				    	}
				    	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		$next = $page + 1;
				    		echo "<a href='list.php?page=$next'> 다음 ▶</a>";
				    	}
					   	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		echo "<a href='list.php?page=$total_page'>마지막</a>";
				    	}
					?>
          </div>
          <div id="write_btn">
            <a href="write.php"><button class="btn btn-primary float-end">글쓰기</button></a>
          </div>
          <div id="search_box" style="text-align: center; padding-top: 50px;">
            <form action="search_result.php" method="get">
              <select name="sele">
                <option value="title">제목</option>
                <option value="nick">글쓴이</option>
                <option value="content">내용</option>
              </select>
              <input type="text" name="search" size="40" required="required">
              <button class="btn btn-primary">검색</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="./js/login.js"></script>

  <script>

  <!-- 일반 글 클릭시 해당 idx의 read 페이지로 이동하는 이벤트 -->
  $(function(){
  $(".read_check").click(function(){
  var action_url = $(this).attr("data-action");
  console.log(action_url);
  $(location).attr("href",action_url);
  });
  });
  </script>
	<script src="js/jquery-3.6.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
</body>

</html>
<?php   
  mysqli_close($conn); ?>