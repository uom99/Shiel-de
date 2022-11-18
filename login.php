<!doctype html>
<html lang="ko">
  <head>
    <?php include_once "head.html"?>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/login.js"></script>
  </head>
  
  <body style="background-color:#aca193" class="text-center align-items-center">
    
<main class="form-signin ">
  <div class="container bg-white rounded-3">
  <form name="loginSbmt" id="loginSbmt" method="post" action="login_ok.php">
  <a class="navbar-brand" href="index.php"><img src="./imgs/L_logo.png" alt="로고" class=" mt-2" aria-current="page" ></a>
    <br><br><br><br>

    <div class="form-check">
      <div class="float-end">
      <label for="p_login">개인<input type="radio" name="login_ck" id="p_login" value="person" class="form-check-input login_ck" checked> </label>
      &ensp;&ensp;&ensp;&ensp;&ensp;
      <label for="c_login">기업<input type="radio" name="login_ck" id="c_login" value="company" class="form-check-input login_ck"> </label>
      </div>
    </div>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="id">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="pass">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <div class="float-first">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
        <br>
        </label>
        </div>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Log-in</button>
    <label style="text-decoration:none;">
        <a href="find_id.php" class="float-first ">아이디 찾기</a>  |
        <a href="find_pw.php">비밀번호 재설정</a>  |
        <a href='signup_select.php'>회원가입</a>
      </label>
  
    <p class="mt-5 mb-3 text-muted text-black">&copy;2022</p>
  </form>
  </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
crossorigin="anonymous"></script>

  </body>
  <style>
    a{
      color:black;
      text-decoration:none;
      font-size:12px;
    }
  </style>
</html>