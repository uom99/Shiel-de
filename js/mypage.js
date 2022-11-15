$(function(){

  $(document).ready(function() {
    $('.write_ck').change(function() {
      var result = $('input[name="mywrite"]:checked').val()

      if (result == 'myboard') {
        $('.myboard').show();
        $('.myreply').hide();
        $('.mylikes').hide();
      } 
      else if(result =='myreply'){
        $('.myreply').show();
        $('.myboard').hide();
        $('.mylikes').hide();
      }
      else{
        $('.mylikes').show();
        $('.myboard').hide();
        $('.myreply').hide();
      }
  
    }); 
  }); 

})