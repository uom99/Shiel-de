<?php include_once "config.php";?>
<!DOCTYPE html>
<html lang="en">

<head>
  
<?php
  include "head.html";
?>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="js/jquery-3.6.1.min.js"></script>
<script src="js/modify.js" defer></script>
</head>

<body class="bg-opacity-75" style="background-color:#aca193">
  <header>
    <?php include_once "header.php" ;?>
  </header>
  <?php 
include "conn.php";
    $mp_sql="SELECT * FROM company WHERE c_id='$userid'";
    $result = mysqli_query($conn,$mp_sql);
    $mp_user = mysqli_fetch_array($result);
  
    ?>


  <main class="container mt-5 pt-5">
    <div class="d-flex align-items-center p-3 my-3 bg-white rounded shadow-sm">
      <div class="lh-1 text-center">
        <h1 class="h6 mb-0 text-black lh-1 text-center">내 정보 수정</h1>
      </div>
      <a href="index.php" class="ms-auto">
        <img class="me-3" src="imgs/logo11.png" alt="로고" width="90" height="38"></a>
    </div>
    <form action="cpage_modify_ok.php" method="POST">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">로그인 정보</h6>

        <hr class="p-0 m-0 border-0">
        <div class="d-flex text-muted pt-3">
          <p class="pb-1 mb-0 small lh-sm w-25">
            <strong class="d-block text-gray-dark">닉네임</strong>
            <input class="form-control " type="text" name="nick" id="nickname" value="<?= $mp_user['c_nick'];?>">
          </p>&nbsp;&ensp;
          <input type="button" class="m-0 btn btn-secondary h-25 mt-3" onclick="modify()" value="중복확인">
        </div>
        <div id="nickErr" class="m-0 help-block text-danger"></div>
        <hr class="p-0 m-0 border-0">
        <div class="d-flex text-muted pt-3 ">
          <p class="pb-3 mb-0 small lh-sm  w-25">
            <strong class="d-block text-gray-dark">이메일</strong>
            <input class="form-control" type="email" name="id" id="id" value="<?= $mp_user['c_id'];?>" disabled>
          </p>
        </div>
        <hr class="p-0 m-0 border-0">
        <div class="d-flex text-muted pt-3">
          <p class="pb-3 mb-0 small lh-sm w-25 ">
            <strong class="d-block text-gray-dark">비밀번호</strong>
            <input class="form-control" type="password" name="pass" id="pass" value="********" disabled>
          </p>&nbsp;&ensp;
          <input type="button" class="m-0 btn btn-secondary h-25 mt-3" onclick="location.href='pw_change.php'" value="비밀번호 변경">
        </div>
        <hr class="p-0 m-0 border-0">
       
</div>
      <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">기업정보</h6>
        <div class="d-flex text-muted pt-3">
          <p class="pb-3 mb-0 small lh-sm w-25">
            <strong class="d-block text-gray-dark">이름</strong>
            <input class="form-control" type="text" name="uname" id="uname" value="<?= $mp_user['c_name'];?>">
          </p>
        </div>
        <hr class="p-0 m-0 border-0">
        <div class="d-flex text-muted pt-3">
          <p class="pb-3 mb-0 small lh-sm w-25 ">
            <strong class="d-block text-gray-dark">기업소개</strong>
            <textarea class="form-control"name="c_intro" id="c_intro" pattern="[a-z][ㄱ-ㅎ][ㅏ-ㅣ][가-힣][0-9]{100}" placeholder="최대 100자이내" maxlength="100" cols="20" rows="5"><?=$mp_user['c_intro']?></a></textarea>
          </p>
        </div>
        <hr class="p-0 m-0 border-0">
        <div class="d-flex text-muted pt-3">
          <p class="pb-3 mb-0 small lh-sm w-25 ">
            <strong class="d-block text-gray-dark">전화번호</strong>
            <input class="form-control" type="tel" name="phone" id="phone" value="<?= $mp_user['c_tel'];?>" pattern="[0-9]{2,3,4}-[0-9]{3,4}-[0-9]{4}"  oninput="p_autoHyphen(this)" maxlength="13">
          </p>
        </div>
        <hr class="p-0 m-0 border-0">
        <div class="d-flex text-muted pt-3">
          <p class="pb-3 mb-0 small lh-sm w-25 ">
            <strong class="d-block text-gray-dark">주소</strong>
            <input type="text" class="rounded-3" id="postcode" placeholder="우편번호" name="postcode" required disabled>
             <input class="form-control" type="text" class="w-100" id="address" name="address"  value="<?= $mp_user['c_address'];?>" readonly>
            <input type="button" class="btn-outline-secondary rounded-3" onclick="DaumPostcode()" value="주소 찾기"><br>
          </p>
        </div>
        <hr class="p-0 m-0 border-0">
        <div class="d-flex text-muted pt-3">
          <p class="pb-3 mb-0 small lh-sm w-25 ">
            <strong class="d-block text-gray-dark">상세주소</strong>
            <input class="form-control" type="text" name="address2" id="address2" value="<?= $mp_user['c_add_detail'];?>">
          </p>
        </div>
        <hr class="p-0 m-0 border-0">
        <small class="d-block text-end mt-3">
          <button type="submit" class=" btn btn-secondary ">수정완료</button>
        </small>
      </div>
    </form>
    </div>
  </main>
  <script defer src="js/address.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script>
      const p_autoHyphen = (target) => {
    target.value = target.value
      .replace(/[^0-9]/g, '')
      .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  }
  </script>
</body>

</html>

