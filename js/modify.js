// function modify(){
// $(document).ready(function(e) { 
//   $("#nickname").on("keyup", function(){
//     var self = $(this); 
//     var nick = $('#nickname').val(); 
    
//     if(self.attr("id") === "nick"){ 
//       nick = self.val(); 
//     } 
    
//     $.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
//       "nick_check.php",
//       { nick : nick }, 
//       function(data){ 
//         if(data){ //만약 data값이 전송되면
//           self.parent().parent().find("div").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
//         }
//       }
//     );
//   });
// });
// }
function modify(){
  var self = $('#nickname');
  var nick = $('#nickname').val();

  if(self.attr("id") === "nick"){ 
          nick = self.val(); 
        } 
        
        $.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
          "modi_nick_check.php",
          { nick : nick }, 
          function(data){ 
            if(data){ //만약 data값이 전송되면
              self.parent().parent().parent().find("#nickErr").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
            }
          }
        );

  }