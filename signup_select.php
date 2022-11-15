
<html lang="ko"><head>
    <title>회원유형 선택</title>
    <?php include "head.html"; ?>
  </head>
  <body style="background-color:#aca193" class="h-75" >

<main>
      <header>
    <?php include "header.php"; ?>
    </header>
  <div class="container ">


    <div class="p-4 mb-3 pt-5 mt-5 bg-dark rounded-3">
      <div class="container-fluid text-white">
        <h1 class="display-6 fw-bold text-white text-center  mt-3">회원유형 선택</h1>
        <li>기업회원이란 인허가번호가 있는 사업자가 대표자 인증을 통해 회원 가입 하시는 경우로 회원가입시 사업자번호를 등록해주셔야합니다.</li>
        <li>개인회원은 누구나 회원으로 가입할수 있습니다.</li>
                  <hr class="mb-4">
      </div>
    </div>

    <div class="row align-items-md-stretch text-center mt-5">
      <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-light rounded-3">
        <div class="join-common">
			    <div class="join-common-r">
			    </div>
			    <div class="join-common-l">
				<img alt="일반회원" src="imgs/person.png"  width="140" height="140" >
        <div class="join-common-r">
				<span class="tit-common text-info">일반회원</span><br>
				<span class="common-info text-dark">14세 이상 개인</span><br>
			    </div>
			    </div>
			</div>
      <form method="post" action="signup.php">
          <button class="btn btn-outline-dark mt-3" type="submit">일반 회원가입</button>
          </form>
        </div>
      </div>

      <div class="col-md-6 ">
        <div class="h-100 p-5 bg-light  rounded-3">
        <div class="join-common">
			    <div class="join-common-r">
			    </div>
			    <div class="join-common-l">
				<img alt="기업회원" src="imgs/company.png"  width="140" height="140">
        <div class="join-common-r">
				<span class="tit-common text-danger">기업회원</span><br>
				<span class="common-info text-dark">사업자 및 기타 단체</span><br>
			    </div>
			    </div>
			</div>
      <form method="post" action="signup_com.php">
          <button class="btn btn-outline-dark mt-3" type="submit">기업 회원가입</button>
</form>
        </div>
      </div>
    </div>

  </div>

</main>


    
  

</body></html>