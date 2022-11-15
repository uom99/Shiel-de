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
                <button id="btn-image" type="button" oninput="insertImageDate()" class="btn btn-outline-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
</svg></button></td>
            </tr>
            <tr>
              <td><div contentEditable="true" class="form-control" id="Editor" style="min-height: 350px"
                  required></div></td>
            </tr>
          </tbody>
        </table>
        <textarea name="content" id="ucontent" style="display:none"></textarea>
        <input style="display:none" type="file" id="img-selector" class="form-control upload" name="uploadfile[]" accept="image/*" multiple><br><br>
        <button type="submit" class="btn btn-dark btn-outline-secondary text-white float-end">글쓰기</button>
        <div style="width: 10px; height: auto; display: inline-block;"></div>
        <button type="button" onclick="location.href='board.php'"
          class="btn btn-dark btn-outline-secondary text-white float-end mx-2">&nbsp;이전&nbsp;</button>
      </form>
    </div>
  </div>
  <script src="/js/login.js"></script>

  <script>
    const editor = document.getElementById('Editor');
    const btnImage = document.getElementById('btn-image');
    const imageSelector = document.getElementById('img-selector');
    
    btnImage.addEventListener('click', function () {
        imageSelector.click();
    });

    imageSelector.addEventListener('change', function (e) {
        const files = e.target.files;
        if (!!files) {
            insertImageDate(files[0]);
        }
    });
    
    function insertImageDate(file) {
        const reader = new FileReader();
        reader.addEventListener('load', function (e) {
            focuseditor();
            document.execCommand('insertImage', false, `${reader.result}`);
        });
        reader.readAsDataURL(file);
    }
    function focuseditor(){
      editor.focus({preventScroll:true});
    }
</script>
</body>

</html>
<?php } ?>


