<!doctype html>
<html lang="ko">
  <head>
    <?php include_once "head.html"?>
    <link rel="stylesheet" href="css/login.css">
  </head>
  
  <body class="text-center align-items-center" style="background-color:#aca193" >
    
<main class="form-signin ">
  <div class="container bg-white rounded-3">
  <form name="loginSbmt" id="loginSbmt" method="post" action="find_pw_ok.php">
  <a class="navbar-brand" href="index.php"><img src="imgs/L_logo.png" alt="로고" class="mt-2" aria-current="page" ></a>
    <br><br><br><br>

    <div class="form-check">
      <div class="float-end">
      <label for="p_login">개인<input type="radio" name="find_pw_ck" id="p_login" value="person" class="form-check-input find_pw_ck" checked> </label>
      &ensp;&ensp;&ensp;&ensp;&ensp;
      <label for="c_login">기업<input type="radio" name="find_pw_ck" id="c_login" value="company" class="form-check-input find_pw_ck"> </label>
      </div>
    </div>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="" name="id" required>
      <label for="floatingInput">이메일</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="" name="uname" required>
      <label for="floatingInput">이름</label>
    </div>
    <div class="form-floating">
      <input type="text" class="form-control"  maxlength="13" name="phone" required oninput="p_autoHyphen(this)">
      <label for="floatingPassword">전화번호</label>
    </div>
<br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">비밀번호 재설정</button>
    <button class="w-100 btn btn-lg btn-primary mt-3" type="button" onclick="location.href='login.php'">돌아가기</button>
  
    <p class="mt-5 mb-3 text-muted text-black">&copy;2022</p>
  </form>
  </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
crossorigin="anonymous"></script>

<script>
  $(function(){
    $(document).ready(function() {
    $('.find_pw_ck').change(function() {
      var result = $('input[name="find_pw_ck"]:checked').val()

      if (result == 'person') {
        $('#loginSbmt').removeAttr("action");
        $('#loginSbmt').attr("action","find_pw_ok.php");
        
        
      } 
      else{
        $('#loginSbmt').removeAttr("action");
        $('#loginSbmt').attr("action","find_cpw_ok.php");
      }
  
    }); 
  }); 
  })
</script>

<script>
  const p_autoHyphen = (target) => {
    target.value = target.value
      .replace(/[^0-9]/g, '')
      .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  }
</script>
  </body>
</html>
