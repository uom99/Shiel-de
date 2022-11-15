$(function() {
  $(document).ready(function () {
    $("#passok, #pass").keyup(function () {
      var passok = $("#passok").val();
      var pass = $("#pass").val();

      // 비밀번호 같은지 확인
      if (passok == pass) {
        $('#join_btn').attr('disabled',false);
        $("#passok").addClass("is-valid");
        $("#passok").removeClass("is-invalid");
        $("#rePwdErr").hide();
      } else {
        $('#join_btn').attr('disabled',true);
        $("#passok").addClass("is-invalid");
        $("#passok").removeClass("is-valid");
        $("#rePwdErr").show();
      }
    });
  });
});
