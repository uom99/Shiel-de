$(function (){

$(".btn-like").on("click", function(e) {
  var button = $(e.currentTarget || e.target)
  var likeCount = button.find(".like-count")
  var heartShape = button.find(".heart-shape")
  $.post("./likes.php", {
      articleId: button.data("articleId")
  }, function(res) {
    console.log(res)

      var addCount = (res == "like" ? 1 : res == "unlike" ? -1 : 0)
      likeCount.text(+likeCount.text() + addCount)
      heartShape.text(res == "like" ? "♥" : res == "unlike" ? "♡" : "♡")
  })
  
})

});

