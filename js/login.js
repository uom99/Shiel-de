$(function(){
function check_input()
{
  alert("아이디를 입력하세요");
    if (!document.loginSbmt.id.value)
    {
        alert("아이디를 입력하세요");    
        document.loginSbmt.id.focus();
        return;
    }

    if (!document.loginSbmt.pass.value)
    {
        alert("비밀번호를 입력하세요");    
        document.loginSbmt.pass.focus();
        return;
    }
    document.loginSbmt.submit();
}

$(document).ready(function() {
    $('.login_ck').change(function() {
      var result = $('input[name="login_ck"]:checked').val()

      if (result == 'person') {
        $('#loginSbmt').removeAttr("action");
        $('#loginSbmt').attr("action","login_ok.php");
        
        
      } 
      else{
        $('#loginSbmt').removeAttr("action");
        $('#loginSbmt').attr("action","c_login_ok.php");
      }
  
    }); 
  }); 

})


