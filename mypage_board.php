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

              while($board = mysqli_fetch_array($result)){
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

<div id="page_num" style="text-align: center;">
  <?php
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		echo "<a href='mypage.php?page=1'>처음</a>";
				    	}
				    	
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		$pre = $page - 1;
				    		echo "<a href='mypage.php?page=$pre'>◀ 이전 </a>";
				    		
				    	}
				    	
				    	for($i = $block_start; $i <= $block_end; $i++){
				    		if($page == $i){
				    			echo "<b> $i </b>";
				    		} else {
				    			echo "<a href='mypage.php?page=$i'> $i </a>";
				    		}
				    	}
				    	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		$next = $page + 1;
				    		echo "<a href='mypage.php?page=$next'> 다음 ▶</a>";
				    	}
					   	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		echo "<a href='mypage.php?page=$total_page'>마지막</a>";
				    	}
					?>
</div>
</div>