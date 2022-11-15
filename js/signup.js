$(function(){
  $(document).ready(function() {
    $("#passok, #pass").keyup(function(){
        var passok= $("#passok").val();
        var pass=$("#pass").val();

        // 비밀번호 같은지 확인
        if(passok==pass) {
          // $('#join_btn').removeAttr('disabled');
          $('#passok').addClass('is-valid')
          $('#passok').removeClass('is-invalid')
          $("#rePwdErr").hide();
          // successState("#pass");
          // successState("#passok");
            
          } else {
            // $('#join_btn').attr('disabled',true);
            $('#passok').addClass('is-invalid')
            $('#passok').removeClass('is-valid')
            $("#rePwdErr").show();
            // errorState("#pass");
            // errorState("#passok");
          }
    });
  }); 

  $(document).ready(function(e) { 
    var id = $('#id').val();
    var email = $('#email').val();
    var full_id = id+'@'+email;
    $('".#id."".#input_id."').on("keyup", function(){
      var self = $(this); 
      var userid = ($('".#id."@".#input_id."').val()); 
      
      if(self.attr("id") === "userid"){ 
        userid = self.val(); 
      } 
      
      $.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
        "email_check.php",
        { userid : userid }, 
        function(data){ 
          if(data){ //만약 data값이 전송되면
            self.parent().parent().find("div").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
          }
        }
      );
    });
  });

  $(document).ready(function(e) { 
    $("#nickname").on("keyup", function(){
      var self = $(this); 
      var nick = $('#nickname').val(); 
      
      if(self.attr("id") === "nick"){ 
        nick = self.val(); 
      } 
      
      $.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
        "nick_check.php",
        { nick : nick }, 
        function(data){ 
          if(data){ //만약 data값이 전송되면
            self.parent().find("div").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
          }
        }
      );
    });
  });


  const p_autoHyphen = (target) => {
    target.value = target.value
      .replace(/[^0-9]/g, '')
      .replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, `$1-$2-$3`);
  }

const bautoHyphen = (target) => {
  target.value = target.value
    .replace(/[^0-9]/g, '')
    .replace(/^(\d{0,3})(\d{0,2})(\d{0,5})$/g, "$1-$2-$3").replace(/(\-{1,2})$/g, "");
}


$(document).ready(function() {
  $('#email').change(function() {
    var result = $('#email option:selected').val();
    if (result == 'direct') {
      $('#input_email').val('');
      $('#input_email').removeAttr('disabled');
    } 
    else{
      $('#input_email').val($('#email').val());
      $('#input_email').attr('disabled',true);
    }

  }); 
}); 

 
  function sendmail() {
    var id = $('#id').val();
    var input_email = $('#input_email').val();
    var email = $('#email').val();
    var full_id1 = id+'@'+email;
    var full_id2 = id+'@'+input_email;
    $.ajax({
      url				: './sendmail.php',
      data			: {
        param1		: full_id1,
        param2		: full_id2
      },
      type			: 'POST',
      dataType		: 'json',
      success		: function(result) {
        if(result.success == false) {
          alert(result.msg);
          return;
        }
        alert(result.data);
      }
    });
  }


    // 폼 전송 처리
    // $( "#myForm" ).submit(function( event ) {
                  
    //     var pw = $('#pass').val();
    //     var pw2 = $('#passok').val();

    //     if ( pw == pw2 ) {
    //         //alert('참');
    //         $("#myForm").attr("action","signup_ok.php").submit();

    //     }else{
    //         alert('거짓');
    //     }

        // $.post( "//jsonplaceholder.typicode.com/posts", data )
        // .done(function( data ) {
        //   console.log( data.title, data.body );
        // });
    // });
    
});

