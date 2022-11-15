<?php 
	include_once "config.php";
	include_once "conn.php";
	
	// 현재 페이지 번호를 확인
	if (isset($_GET["page"]))
		$page = $_GET["page"]; //1,2,3,4,5
	else
		$page = 1;
	
	$sele = $_GET['sele'];
	$search = $_GET['search'];
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once "head.html"; ?>

</head>

<body>
    <!-- 표준 네비게이션 바 (화면 상단에 위치, 화면에 의존하여 확대 및 축소) -->
    <header class="navbar navbar-default">
        <?php include_once "header.php";?>
    </header>

    <div class="container mt-5 pt-3">
        <div id="board_area">
            <!-- 출력을 위해서 form의 title, name, content 값을 제목, 글쓴이, 내용으로 변경하기 위한 조건문 -->
            <?php 
				if($sele == 'title'){
					$keyword = '제목';
				} else if($sele == 'nick'){
					$keyword = '글쓴이';
				} else{
					$keyword = '내용';
				}
			?>
            <h3>'<?=$keyword?>' 에서 '<b><?=$search?></b>' 검색결과는 다음과 같습니다.</h3>
            <br>
            <table class="table table-hover mt-1" style=" border: 1px solid #ddddda">
                <tr>
                    <th style="background-color: #ddffff; text-align: center;">번호</th>
                    <th style="background-color: #ddffff;">카테고리</th>
                    <th style="background-color: #ddffff;">제목</th>
                    <th style="background-color: #ddffff; text-align: center;">작성자</th>
                    <th style="background-color: #ddffff; text-align: center;">작성일</th>
                    <th style="background-color: #ddffff; text-align: center;">조회수</th>
                    <th style="background-color: #ddffff; text-align: center;">좋아요</th>
                </tr>
                <!-- 검색한 결과 페이징 구현 -->
                <?php 
			    	$sql2 = "select 
			    					* 
			    				from 
			    					board 
			    				where
			    					$sele like '%{$search}%'
			    				order by 
			    					idx desc
			    			";
            $result2 = mysqli_query($conn,$sql2);
			    	$total_record = mysqli_num_rows($result2); // 검색된 게시판 총 레코드 수
			    	
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
			    	
			    	/* 검색된 게시글 정보 가져오기  limit : (시작번호, 보여질 수) */
			    	$sql2 = "select 
			    					* 
			    				from 
			    					board 
			    				where
			    					$sele like '%{$search}%'
			    				order by 
			    					idx desc limit $page_start,$list
			    			";
            $result2 = mysqli_query($conn,$sql2);

			    	while($board = $result2->fetch_array()){
			    		$title=$board["title"];
			    		/* 글자수가 30이 넘으면 ... 처리해주기 */
			    		if(strlen($title)>30){
			    			$title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
			    		}
			    		$sql3 = "select 
			    						* 
			    					from 
			    						reply 
			    					where 
			    						idx='".$board['idx']."'
			    				";
              $result3 = mysqli_query($conn,$sql3);
			    		$rep_count = mysqli_num_rows($result3);
			    				    	
			    ?>

                <!-- 글 목록 가져오기 -->

                <tr class="read_check" style="cursor:pointer" data-action="read.php?idx=<?=$board['idx']?>">
                    <td style="text-align : center" width="70"><?=$board['idx'];?></td>
                    <td width="150"><?=$board['category']?></td>
                    <td width="300"><?=$title?> <span class="text-danger"
                            style="font-size:14px">[<?=$rep_count?>]</span> </td>
                    <td style="text-align : center" width="120"><?=$board['nick']?></td>
                    <td style="text-align : center" width="200"><?=$board['date'];?></td>
                    <td style="text-align : center" width="110"><?=$board['hit']; ?></td>
                    <td style="text-align : center" width="110"><?=$board['like_count']?></td>
                </tr>


                <?php } ?>
            </table>
            <div id="page_num" style="text-align: center;">
			<ul class="pagination justify-content-center">
                <?php
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		$pre = $page - 1;
								echo "<li class='page-item'><a class='page-link' href='search_result.php?sele=$sele&search=$search&page=1'> &laquo;</a></li>";
				    		echo "<li class='page-item'><a class='page-link' href='search_result.php?sele=$sele&search=$search&page=$pre'> < </a></li>";
				    	}
				    	
				    	for($i = $block_start; $i <= $block_end; $i++){
				    		if($page == $i){
				    			echo "<li class='page-item active'><a class='page-link' href='search_result.php?sele=$sele&search=$search&page=$i'> $i </a></li>";
				    		} else {
				    			echo "<li class='page-item'><a class='page-link' href='search_result.php?sele=$sele&search=$search&page=$i'> $i </a></li>";
				    		}
				    	}
				    	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		$next = $page + 1;
				    		echo "<li class='page-item'><a class='page-link' href='search_result.php?sele=$sele&search=$search&page=$next'> > </a></li>";
								echo "<li class='page-item'><a class='page-link' href='search_result.php?sele=$sele&search=$search&page=$total_page'> &raquo; </a></li>";
				    	}
					   	
					?>
					</ul>
            </div>
            <br><br><br>
            <div id="search_box" style="text-align: center;">
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
    <script>
    <!-- 일반 글 클릭시 해당 idx의 read 페이지로 이동하는 이벤트 
    -->
    $(function() {
    $(".read_check").click(function() {
    var
    action_url
    =
    $(this).attr("data-action");
    $(location).attr("href", action_url);
    });
    });
    </script>
</body>

</html>