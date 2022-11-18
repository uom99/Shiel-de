<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shielde</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/signup.css">
    <script src="js/jquery-3.6.1.min.js" defer></script>
    <script src="js/signup.js" defer></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <!-- <script defer src="js/join.js"></script> -->
</head>

<body style="background-color:#aca193">
  
  <div class="container w-100 h-100 mb-5">
    <div class="input-form-backgroud row">
      <div class="input-form col-md-12 mx-auto">
        <h4 class="mb-3">회원가입</h4>
        <form id="myForm" method="POST" name="register" class="" action="signup_ok.php">
        <div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name">이름</label>
              <input type="text" class="form-control" id="name" placeholder="" value="" name="uname" required>
              <div class="invalid-feedback">
                이름을 입력해주세요.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nickname">별명</label>
              <input type="text" class="form-control" id="nickname" placeholder="" name="nick" required>

              <!-- <div class="valid-feedback text-info">
                사용가능한 닉네임 입니다.
            </div> -->
            <div id="nickErr" class="help-block text-danger">중복된 닉네임 입니다.</div>
            </div>
          </div>

          <div class="row">
          <label class="control-label" for="email">이메일</label>
          <div id="full_id" class="col-md-8 has-feedback mb-3 d-flex">    
            <input class="form-control" type="text" name="id" id="id" placeholder="e-mail" required><br>@
            <input type="text" class="form-control" name="input_email" id="input_email" disabled>
          </div>
            <div class="col-md-4 mb-3">
              <br>
            <select name="email" id="email">
              <option value="naver.com">naver.com</option>
              <option value="nate.com">nate.com</option>
              <option value="hanmail.net">hanmail.net</option>
              <option value="gmail.com">gmail.com</option>
              <option value="yahoo.com">yahoo.com</option>
              <option value="direct">직접입력</option>
            </select>
            <!-- <span><input type="button" id="send" class="btn-light btn-outline-secondary rounded-3 w-25" onclick="location.href='sendmail.php'" value="인증"></span> -->
            <div id="IDErr" class="help-block text-danger">중복된 이메일 입니다.</div>
            </div>
        </div>
        

          <div class="form-group has-feedback mb-3">
            <label class="control-label" for="pass">비밀번호</label>
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

          
          <div class="mb-3 col-md-12 ">
            <label for="phone">휴대폰 번호<span class="text-muted">&nbsp;( - 포함 )</span></label>
            <input type="text" class="form-control" id="phone" placeholder="010-XXXX-XXXX" required name="phone" pattern="[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}" oninput="p_autoHyphen(this)" maxlength="13">
            <div class="invalid-feedback">
              휴대폰 번호를 입력해주세요.
            </div>
          </div>

          <!-- <div class="col-md-2 ">
            <label for="phone_ck"></label>
            <input type="button" class="form-control" id="phone_ck" placeholder="010-XXXX-XXXX" value="인증" name="phone_ck">
          </div> -->


          <div class="mb-3">
            <label for="birthday">생년월일</label>
            <input type="date" class="form-control" id="birthday" placeholder="" required name="birthday">
            <div class="invalid-feedback">
              생년월일을 입력해주세요.
            </div>
          </div>

          <div class="mb-3">
            <label for="address">주소</label><br>
            <input type="text" class="rounded-3" id="postcode" placeholder="우편번호" name="postcode" required disabled>
            <input type="button" class="btn-outline-secondary rounded-3" onclick="DaumPostcode()" value="주소 찾기"><br>
            <input type="text" id="h_address" name="h_address" required style="opacity: 0; height:0px;">
            <input type="text" class="form-control" id="address" placeholder="주소를 입력해주세요" name="address" readonly>
            <div class="invalid-feedback">
              주소를 입력해주세요.
            </div>
            <input type="text" class="form-control" id="address2" name="address2" placeholder="상세주소를 입력해주세요.">
          </div>
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="aggrement" required>
            <label class="custom-control-label" for="aggrement">개인정보 수집 및 이용에 동의합니다.</label>
          </div>
          <div class="mb-4"></div>
          <button class="btn btn-primary btn-lg btn-block w-100" id="join_btn" type="submit">가입 완료</button>
          <div class="mb-1"></div>
          <a href="index.php"><button class="btn btn-danger btn-lg btn-block w-100" type="button">돌아가기</button></a>
        </form>
      </div>
    </div>



    <footer class="my-3 text-center text-small">
      <p class="mb-1">&copy; 2022 ShieldE</p>
    </footer>
  </div>
 
<script src="js/address.js"></script>
<script defer>
  const p_autoHyphen = (target) => {
    target.value = target.value
      .replace(/[^0-9]/g, '')
      .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  }


</script>
</body>

</html>
