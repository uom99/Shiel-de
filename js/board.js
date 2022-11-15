// $(document).ready(function () {

//   $(".btn-like").each(function(idx, el) {
//       var button = $(el)
//       var heartShape = button.find(".heart-shape")
//       $.get("./like_proc.php", {
//           getLikedByCode: button.data("articleId")
//       }, function(res) {
//           heartShape.text(res == "liked" ? "♥" : "♡")
//           button.fadeIn(500)
//       })
      
      
//   })
//   $('.btn-like').click(function(){
//     var pk = $(this).attr('name') // 클릭한 요소의 attribute 중 name의 값을 가져온다.
//     $.ajax({
//         url: "{% url 'pledge:pledge_like' pledge.pk %}", // 통신할 url을 지정한다.
//         data: {'csrfmiddlewaretoken': '{{ csrf_token }}'}, // 서버로 데이터를 전송할 때 이 옵션을 사용한다.
//         dataType: "json", // 서버측에서 전송한 데이터를 어떤 형식의 데이터로서 해석할 것인가를 지정한다. 없으면 알아서 판단한다.
  
//         success: function(response){
//           // 요청이 성공했을 경우 좋아요/싫어요 개수 레이블 업데이트
//           $('#like_count'+ pk).html("count : "+ response.like_count);
//           $('#dislike_count'+ pk).html("count : "+ response.dislike_count);
//         },
//         error:function(error){
//           // 요청이 실패했을 경우
//           alert(error)
//         }
//     });
//   })
// })

  
