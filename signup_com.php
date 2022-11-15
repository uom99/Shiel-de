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
        <form id="myForm" method="POST" name="register" class="" action="c_signup_ok.php">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name">회사명</label>
              <input type="text" class="form-control" id="name" placeholder="" value="" name="uname" required>
              <div class="invalid-feedback">
                이름을 입력해주세요.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="nickname">별명</label>
              <input type="text" class="form-control" id="nickname" placeholder="" name="nick" required>
              <div class="invalid-feedback">
                중복된 닉네임 입니다.
              </div>
              <div class="valid-feedback">
                사용가능한 닉네임 입니다.
            </div>
            <div id="nickErr" class="help-block text-danger">중복된 닉네임 입니다.</div>
            </div>
          </div>
          <div class="row">
          <div class="col-md-9 has-feedback mb-3">
            <label class="control-label" for="bcode">사업자등록번호</label>
            <input class="form-control" type="text" name="bcode" id="bcode" placeholder="사업자등록번호" oninput="b_autoHyphen(this)" pattern="[0-9]{3}-[0-9]{2}-[0-9]{5}" maxlength='12' required>
            <div class="invalid-feedback">
              비밀번호를 입력해주세요.
            </div>
            <div id="bcodeErr" class="help-block text-danger"></div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-2 ">
            <label for="phone_ck"></label>
            <input type="button" class="form-control" id="bcode_ck" value="인증" name="bcode_ck"  onclick="bcode_chk()" >
          </div>
          </div>
          <div class="row">
          <label class="control-label" for="email">이메일</label>
          <div class="col-md-8 has-feedback mb-3 d-flex">
            
            <input class="form-control" type="text" name="id" id="id" placeholder="e-mail" required><br>@
            <input type="text" class="form-control" name="input_email" id="input_email" required disabled>
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
            </div>

            <div id="IDErr" class="help-block text-danger">중복된 이메일 입니다.</div>
            
        
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
            <label for="phone">전화 번호<span class="text-muted"></span></label>
            <input type="text" class="form-control" id="phone" placeholder="010-XXXX-XXXX" required name="phone" pattern="[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}" maxlength="13" oninput="p_autoHyphen(this)">
            <div class="invalid-feedback">
              휴대폰 번호를 입력해주세요.
            </div>
          </div>

          <!-- <div class="col-md-2 ">
            <label for="phone_ck"></label>
            <input type="button" class="form-control" id="phone_ck" placeholder="010-XXXX-XXXX" value="인증" name="phone_ck">
          </div> -->


          <div class="mb-3">
            <label for="address">주소</label><br>
            <input type="text" class="rounded-3" id="postcode" placeholder="우편번호" name="postcode" required disabled>
            <input type="button" class="btn-outline-dark rounded-3" onclick="DaumPostcode()" value="주소 찾기"><br>
            <input type="text" class="form-control" id="address" placeholder="주소를 입력해주세요" name="address" required readonly>
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
 
  <script>
    function DaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var addr = ''; // 주소 변수
                var extraAddr = ''; // 참고항목 변수

                //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                    addr = data.roadAddress;
                } else { // 사용자가 지번 주소를 선택했을 경우(J)
                    addr = data.jibunAddress;
                }

                // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                if(data.userSelectedType === 'R'){
                    // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                    // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                    if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                        extraAddr += data.bname;
                    }
                    // 건물명이 있고, 공동주택일 경우 추가한다.
                    if(data.buildingName !== '' && data.apartment === 'Y'){
                        extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                    }
                    // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                    if(extraAddr !== ''){
                        extraAddr = ' (' + extraAddr + ')';
                    }
                    // 조합된 참고항목을 해당 필드에 넣는다.
                    document.getElementById("address").value = extraAddr;
                
                } else {
                    document.getElementById("address").value = '';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('postcode').value = data.zonecode;
                document.getElementById("address").value = addr;
                // 커서를 상세주소 필드로 이동한다.
                document.getElementById("address2").focus();
            }
        }).open();
    }
</script>
<!-- <script>
  function bcode_ck(){
	var bcode = $('#bcode').val();
	if(bcode)  
	{
		url = "business_code_ok.php?bcode="+bcode;
		window.open(url,"chkid","width=400,height=200");
	} else {
		alert("아이디를 입력하세요.");
	}
}
</script> -->

<script>
  const p_autoHyphen = (target) => {
    target.value = target.value
      .replace(/[^0-9]/g, '')
      .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  }

const b_autoHyphen = (target) => {
  target.value = target.value
    .replace(/[^0-9]/g, '')
    .replace(/^(\d{0,3})(\d{0,2})(\d{0,5})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
}
</script>

<script>
function bcode_chk() {
  var bcode = $('#bcode').val();
  var new_bcode = bcode.replace(/-/g, "");
  var data = {
    "b_no": [new_bcode] // 사업자번호 "xxxxxxx" 로 조회 시,
    
   }; 
   
$.ajax({
  url: "https://api.odcloud.kr/api/nts-businessman/v1/status?serviceKey=eNBva%2Bfz8Wkxtg6SR6fLq4MaVn1YniMn2ht%2FeJlpZYDDCKzkYxEDc0ToG8aPlA5aRMWHoG3btu5D1U0UXXvMpw%3D%3D",  // serviceKey 값을 xxxxxx에 입력
  type: "POST",
  data: JSON.stringify(data), // json 을 string으로 변환하여 전송
  dataType: "JSON",
  contentType: "application/json",
  accept: "application/json",
  success: function(result) {
      console.log(result);
      var data = JSON.parse(result);
      
      alert (data);
      
  },
  error: function(result) {
      console.log(result.responseText); //responseText의 에러메세지 확인
  }
});
}
</script>

<script>

  function bcode_chck(){

  var bcode = $('#bcode').val();
  var new_bcode = bcode.replace(/-/g, "");
  
  var url = "https://bizno.net/api/fapi?key=cG9seUB0ZWNoLmNvbSAg&status=Y&gb=1&q="+new_bcode;

  }
</script>


</body>

</html>
