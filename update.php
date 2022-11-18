<?php
	include "config.php";
	include "conn.php";
	include "login_check.php";
	
	$bno = $_GET['idx']; // $bno에 idx값을 받아와 넣음
	/* 받아온 idx값을 선택해서 게시글 정보 가져오기 */
	$sql = "select * from board where idx='$bno'";
  $result = mysqli_query($conn,$sql);
	$board = mysqli_fetch_array($result);	
?>
<!DOCTYPE html>
<html>

<head>
  <?php include_once "head.html";?>

</head>

<body>
  <!-- 표준 네비게이션 바 (화면 상단에 위치, 화면에 의존하여 확대 및 축소) -->
  <header class="navbar navbar-default">
    <?php include_once "header.php";?>
  </header>
  <div class="container mt-5 pt-4">
    <div id="board_write">
      <form action="update_ok.php" method="post">
        <input type="hidden" name="idx" value="<?=$bno?>" />
        <table class="table table-striped" style="border: 1px solid #ddddda">
          <thead>
            <tr>
              <th colspan="2" style="background-color: #eeeeee; text-align: center;">
                <h3>게시판 수정하기</h3>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="pull-left">&ensp;작성자 : <b><?=$usernick?></b></span></td>
            </tr>
            <tr>
              <td><input type="text" class="form-control" placeholder="글 제목" name="title" id="utitle" value="<?=$board['title']?>" required></td>
            </tr>
            <tr>
              <td><select class="form-control form-select" name="category" id="category" style="width: 150px;" required selected="<?=$board['category'];?>">
                  <option value="">게시글 종류</option>
                  <option value="공지">공지</option>
                  <option value="업체공지">업체공지</option>
                  <option value="리뷰">리뷰</option>
                  <option value="질문">질문</option>
                  <option value="일상">일상</option>
                  <option value="유머">유머</option>
                  <option value="자유">자유</option>
                </select></td>
            </tr>
            <tr>
              <td><div  id="smarteditor" required>
                      <textarea class="" name="content" id="editorTxt" style="display:none" required><?php $board['contents'] = str_replace("smarteditor/upload/", "upload/", $board['contents']); echo $board['contents']; ?></textarea>
                      <!-- 
                      -->
                  </div>
              </td>
            </tr>
            <tr>
              <td>
              <!-- <input type="file" class="form-control upload" name="upload_file" accept = "image/png, image/jpeg, image/png"> -->
              </td>
            </tr>
          </tbody>
        </table>
        <button type="submit" class="btn btn-primary float-end" onclick="submitPost()">수정완료</button>
        <button type="button" onclick="back()"
          class="btn btn-dark btn-outline-secondary text-white float-end mx-2">&nbsp;이전&nbsp;</button>
      </form>
    </div>
  </div>
  <script src="jqery-3.6.1.min.js"></script>
  <script src="/js/login.js"></script>
  <script type="text/javascript" src="smarteditor/js/HuskyEZCreator.js"></script>
  <script>
    $('#category').val("<?=$board['category']?>").prop("selected",true);
  </script>

<script>
    let oEditors = []

    smartEditor = function() {
      console.log("Naver SmartEditor")
      nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "editorTxt",
        sSkinURI: "/smarteditor/SmartEditor2Skin.html",
        fCreator: "createSEditor2"
      })
    }

    $(document).ready(function() {
      smartEditor()
    })

  </script>
  <script>
  function submitPost(){
  oEditors.getById["editorTxt"].exec("UPDATE_CONTENTS_FIELD", [])
  let content = document.getElementById("editorTxt").value

  if(content == ""  || content == null || content == '&nbsp;' || content == '<br>' || content == '<br />' || content == '<p>&nbsp;</p>') {
    alert("내용을 입력해주세요.")
    oEditors.getById["editorTxt"].exec("FOCUS")
    return
  } else {
    console.log(content)
  }
}
function back(){
  history.back()
}
</script>
</body>

</html>