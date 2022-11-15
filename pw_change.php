<?php
  include "conn.php";
  include "config.php";

  if($role=='3'){
  $sql = "select * from company where c_nick='$usernick'";
  }
  else{
    $sql = "select * from user where nick='$usernick'";
  }
  $result = mysqli_query($conn,$sql);

  $userpw = mysqli_fetch_array($result);

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/modal.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="css/signup.css">
  <title>Document</title>
</head>

<body style="background-color:#aca193">
  <div class="container">
    <div id="modal" class="modal-overlay">
      <div class="modal-window">
        <div class="title">
          <h2>비밀번호 재설정</h2>
        </div>
        <hr>
        <div class="close-area"></div>
        <div class="content">
          <form action="mypage_reset_pw_ok.php" method="post" id="myForm">

          <input type="hidden" name="id" value="<?=$userpw['id']?>">

            <div class="form-group has-feedback mb-3">
              <label class="control-label" for="nowpass">현재 비밀번호</label>
              <input class="form-control" type="password" name="nowpass" id="nowpass" placeholder="password" required>
              <span class="invalid-feedback">현재 비밀번호와 일치하지않습니다.</span>
            </div>

            <div class="form-group has-feedback mb-3">
              <label class="control-label" for="pass">새로운 비밀번호</label>
              <input class="form-control" type="password" name="pass" id="pass" placeholder="password" required>
              <div class="invalid-feedback">
                비밀번호를 입력해주세요.
              </div>
            </div>

            <div class="form-group has-feedback mb-3">
              <label class="control-label" for="passok">비밀번호 재확인</label>
              <input class="form-control" type="password" name="passok" id="passok" placeholder="password" required>
              <span id="rePwdErr" class="help-block text-danger">비밀번호와 일치하지 않습니다. 다시 입력해 주세요.</span>
            </div>
        </div>
        <div class="mb-1"></div>
        <div class="mb-1">
          <button class="btn btn-primary btn-block float-end" id="join_btn" type="submit" disabled>변경완료</button>

          <button class="btn btn-secondary " onclick="history.back()">돌아가기</button>
        </div>
        </form>
      </div>
    </div>

  </div>

  
  <script src="js/jquery-3.6.1.min.js"></script>
  <script defer src="js/reset_pw.js"></script>
  <script defer>
    $(function(){
    $(document).ready(function () {
    $("#nowpass").keyup(function () {
      var nowpass = $("#nowpass").val();
      var dbpass = <?=$userpass?>;

      // 비밀번호 같은지 확인
      if password_verify(nowpass, dbpass) {
        $('#join_btn').attr('disabled',false);
        $("#nowpass").addClass("is-valid");
        $("#nowpass").removeClass("is-invalid");
        $("#nowPwd").hide();
      } else {
        $('#join_btn').attr('disabled',true);
        $("#nowpass").addClass("is-invalid");
        $("#nowpass").removeClass("is-valid");
        $("#nowPwd").show();
      }
    });
  });
});

  </script>
</body>

</html>