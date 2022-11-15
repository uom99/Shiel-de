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
          <div class="nav w-100 dropdown mt-1">
					<a href="#" data-bs-toggle="dropdown" role="button" class="fs-5 btn btn-dark w-100 dropdown-toggle" id="board_text">일상</a>
            <ul class="blist w-100 dropdown-menu dropdown-menu-dark" id="board_change">
                  <li><button class="board_category dropdown-item btn fs-5 " role="button" value="board_all" onclick="location.href='board.php'">전체게시판</button></li>
                  <li><button class="board_category dropdown-item btn fs-5 " role="button" value="board_notice" onclick="location.href='b_notice.php'">공지사항</button></li>
                  <li><button class="board_category dropdown-item btn fs-5 " role="button" value="board_com_notice" onclick="location.href='b_com_notice.php'">업체공지</button></li>
                  <li><button class="board_category dropdown-item btn fs-5 " role="button" value="board_review" onclick="location.href='b_review.php'">리뷰</button></li>
                  <li><button class="board_category dropdown-item btn fs-5 " role="button" value="board_question" onclick="location.href='b_question.php'">질문</button></li>
                  <li><button class="board_category dropdown-item btn fs-5 " role="button" value="board_life" onclick="location.href='b_life.php'">일상</button></li>
                  <li><button class="board_category dropdown-item btn fs-5 " role="button" value="board_humor" onclick="location.href='b_humor.php'">유머</button></li>
                  <li><button class="board_category dropdown-item btn fs-5 " role="button" value="board_free" onclick="location.href='b_free.php'">자유</button></li>                
              
            </ul>
          </div>
          <!-- <select id="board_category" name="board_cate" class="nav w-100 mt-1 form-select-lg bg-dark opacity-50 text-white">
            <option value="공지" selected>전체게시판</option>
            <option value="공지" >공지사항</option>
            <option value="업체공지" >업체공지</option>
            <option value="리뷰" >리뷰</option>
            <option value="질문" >질문</option>
            <option value="일상" >일상</option>
            <option value="유머" >유머</option>
            <option value="자유" >자유</option>
          </select> -->
          <table class="table table-hover mt-1" style="border: 1px solid #ddddda">
          <tr>
              <th  style="background-color: #ddffff; text-align: center;">번호</th>
              <th  style="background-color: #ddffff;">카테고리</th>
              <th  style="background-color: #ddffff;">제목</th>
              <th  style="background-color: #ddffff; text-align: center;">작성자</th>
              <th  style="background-color: #ddffff; text-align: center;">작성일</th>
              <th  style="background-color: #ddffff; text-align: center;">조회수</th>
              <th  style="background-color: #ddffff; text-align: center;">추천</th>
            </tr>

            <!-- 페이징 구현 -->

            <?php 
            $bc = "<script>document.write (bc);</script>";

			    	$sql = "select * from board where category='일상';";
            // $sql = "<script>document.write(sql)</script>";
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
			    	
			    	/* 게시글 정보 가져오기  limit : (시작번호, 보여질 수) */
			    	$sql2 = "select * from board where category='일상' order by idx desc limit $page_start, $list"; 
						$result2 = mysqli_query($conn,$sql2);
			    	while($board = $result2->fetch_array()){
			    		$title=$board["title"];
			    		/* 글자수가 30이 넘으면 ... 처리해주기 */
			    		if(strlen($title)>30){
			    			$title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
			    		}
			    
			    		/* 댓글 수 구하기 */
              $sql5 = "select * from reply where idx='".$board['idx']."'";
              $result5 = mysqli_query($conn,$sql5);
              $rep_count = mysqli_num_rows($result5);
			    					  
			    ?>

            <!-- 글 목록 가져오기 -->

            <tr class="read_check" style="cursor:pointer" 
            data-action="read.php?idx=<?=$board['idx']?>">
              <td style="text-align : center" width="70"><?=$board['idx'];?></td>
              <td width="150"><?=$board['category']?></td>
              <td width="300"><?=$title?><span class="text-danger" style="font-size:14px">[<?=$rep_count?>]</span></td>
              <td style="text-align : center" width="120"><?=$board['nick']?></td>
              <td style="text-align : center" width="200"><?=$board['date'];?></td>
              <td style="text-align : center" width="110"><?=$board['hit']; ?></td>
              <td style="text-align : center" width="110"><?=$board['like_count']?></td>
            </tr>

            <?php } ?>
          </table>
          <div id="page_num" class="mx-auto center" style="text-align: center;">
            <ul class="pagination justify-content-center">
              <?php
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		echo "<li class='page-item'><a class='page-link' href='b_life.php?page=1'> &laquo; </a></li>";
				    	}
				    	
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		$pre = $page - 1;
				    		echo "<li class='page-item'><a class='page-link' href='b_life.php?page=$pre'> < </a></li>";
				    		
				    	}
				    	
				    	for($i = $block_start; $i <= $block_end; $i++){
				    		if($page == $i){
				    			echo "<li class='page-item active'><a class='page-link' href='b_life.php?page=$i'> $i </a></li>";
				    		} else {
				    			echo "<li class='page-item'><a class='page-link' href='b_life.php?page=$i'> $i </a></li>";
				    		}
				    	}
				    	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		$next = $page + 1;
				    		echo "<li class='page-item'><a class='page-link' href='b_life.php?page=$next'> > </a></li>";
				    	}
					   	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		echo "<li class='page-item'><a class='page-link' href='b_life.php?page=$total_page'> &raquo; </a></li>";
				    	}
					?>
            </ul>
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
  $(location).attr("href",
  action_url);
  });
  });
  </script>
  <script src="js/jquery-3.6.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>

<script defer type="text/javascript">
            $(function() {
              $(document).ready(function() {
                $('#board_category').change(function() {
                  var bc = $('#board_category option:selected').val();
                
                });
              })
            }) 
            </script>

</body>

</html>
<?php   
  mysqli_close($conn); ?>