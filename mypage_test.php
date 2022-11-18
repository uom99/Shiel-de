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
            <button type="button" class="btn btn-danger"
              onclick="location.href='member_withdrawal.php?num=<?=$usernum;?>&role=<?=$role;?>'">탈퇴</button>
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
                <input type="radio" class="btn-check write_ck" value="myboard" name="mywrite" id="mywrite1"
                  autocomplete="off" checked>
                <label class="btn btn-outline-dark" for="mywrite1">내가 쓴 글</label>
                <input type="radio" class="btn-check write_ck" value="myreply" name="mywrite" id="mywrite2"
                  autocomplete="off">
                <label class="btn btn-outline-dark" for="mywrite2">댓글 단 글</label>
                <input type="radio" class="btn-check write_ck" value="mylikes" name="mywrite" id="mywrite3"
                  autocomplete="off">
                <label class="btn btn-outline-dark" for="mywrite3">좋아요 한 글</label>
              </div>
            </div>
            <div class="myboard">
              <table class="table table-hover mt-1">
                <thead>
                  <tr>
                  <th style="background-color: #ddffff; text-align: center;">번호</th>
                  <th style="background-color: #ddffff;">카테고리</th>
                  <th style="background-color: #ddffff;">제목</th>
                  <th style="background-color: #ddffff; text-align: center;">작성일</th>
                  <th style="background-color: #ddffff; text-align: center;">조회수</th>
                  <th style="background-color: #ddffff; text-align: center;">추천</th>
                  </tr>
                </thead>
                <!-- Ajax를 이용해 DB에서 가져온 데이타를 이곳에 넣어주자. -->
                <tbody id="input_data">
                </tbody>
              </table>
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
  $(location).attr("href",
  action_url);
  });
  });
  </script>
  <script>
  < --ajax 로 데이터 가져오기-- >
  $(document).ready(function() {
    $('.write_ck').change(function() {
      var result = $('input[name="mywrite"]:checked').val()

      if (result == 'myboard') {
        $.ajax({
          url: "mypage_board.php",
          type: "post",
          data: $("form").serialize(),
        }).done(function(data) {
          $("#input_data").html(data);
        })
      } else if (result == 'myreply') {
        $.ajax({
          url: "mypage_reply.php",
          type: "post",
          data: $("form").serialize(),
        }).done(function(data) {
          $("#input_data").html(data);
        })
      } else {
        $.ajax({
          url: "mypage_likes.php",
          type: "post",
          data: $("form").serialize(),
        }).done(function(data) {
          $("#input_data").html(data);
        })

      }

    });
  });
  </script>
</body>

</html>
<?php }
mysqli_close($conn)
?>