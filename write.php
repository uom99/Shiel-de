<?php
	include "./config.php";
?>
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
<html>

<head>
  <?php include_once "head.html";?>

<style>
  #editor img{
    max-width:100%;
  }
</style>
</head>

<body>
  <!-- 표준 네비게이션 바 (화면 상단에 위치, 화면에 의존하여 확대 및 축소) -->
  <header>
    <?php include_once "header.php";?>
  </header>
  <div class="container mt-5 pt-4">
    <div id="board_write">
      <form action="write_ok.php" method="post" enctype= "multipart/form-data">
        <table class="table table-striped" style=" border: 1px solid #ddddda">
          <thead>
            <tr>
              <th colspan="2" style="background-color: #eeeeee; text-align: center;">
                <h3>게시판 글쓰기</h3>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="pull-left">&ensp;작성자 : <b><?=$usernick?></b></span></td>
            </tr>
            <tr>
              <td><input type="text" class="form-control" placeholder="글 제목" name="title" id="utitle" required></td>
            </tr>
            <tr>
              <td class="d-flex"><select class="form-control form-select" name="category" id="category" style="width: 150px;" required>
                  <option selected value="">게시글 종류</option>
                  <?php 
                  switch($role){;
                  case '1':?>
                  <option value="공지">공지</option>
                  <option value="업체공지">업체공지</option>
                  <?php break;
                  case '3':
                  ?>
                  <option value="업체공지">업체공지</option>
                  <?php break;

                  }?>
                  <option value="리뷰">리뷰</option>
                  <option value="질문">질문</option>
                  <option value="일상">일상</option>
                  <option value="유머">유머</option>
                  <option value="자유">자유</option>
                </select>&ensp;
              </td>
            </tr>
            <tr>
              <td><div  id="smarteditor" required>
                      <textarea class="" name="content" id="editorTxt" style="display:none" required></textarea>
                  </div></td>
            </tr>
          </tbody>
        </table>
        <button type="submit" id="submit_btn" class="btn btn-dark btn-outline-secondary text-white float-end" onclick="submitPost()">글쓰기</button>
        <div style="width: 10px; height: auto; display: inline-block;"></div>
        <button type="button" onclick="location.href='board.php'"
          class="btn btn-dark btn-outline-secondary text-white float-end mx-2">&nbsp;이전&nbsp;</button>
      </form>
    </div>
  </div>
  <script src="jqery-3.6.1.min.js"></script>
  <script src="/js/login.js"></script>
  <script type="text/javascript" src="smarteditor/js/HuskyEZCreator.js"></script>

  <script>
    
    const editor = document.getElementById('editor');
    const btnImage = document.getElementById('btn-image');
    const imageSelector = document.getElementById('img-selector');
    
    btnImage.addEventListener('click', function () {
        imageSelector.click();
    });

    imageSelector.addEventListener('change', function (e) {
        const files = e.target.files;
        console.log(files);
        if (!!files) {
          for(var i=0;i<files.length;i++){
            insertImageDate(files[i]);
          }
        }
    });
    
    function insertImageDate(file) {
        const reader = new FileReader();
        reader.addEventListener('load', function (e) {
            focusEditor();
            document.execCommand('insertImage', false, `${reader.result}`);
        });
        reader.readAsDataURL(file);
    }

    function focusEditor() {
        editor.focus({preventScroll: true});
    }
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
</script>
</body>

</html>
<?php } ?>


