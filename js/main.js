$(function(){

  $('#fullpage').fullpage({
		//options here
		autoScrolling:true,
		scrollHorizontally: true,
    navigation:true,
    navigationPosition:'right'
	});
	
	$(document).ready(function() {
		$('.bestwriting').change(function() {
			var result = $('input[name="bestw"]:checked').val()

			if (result == 'week_best_likes') {
				$('.week_best_like').show();
				$('.week_best_hit').hide();
				$('.month_best_like').hide();
				$('.month_best_hit').hide();
			} 
			else if(result =='week_best_hit'){
				$('.week_best_hit').show();
				$('.week_best_like').hide();
				$('.month_best_like').hide();
				$('.month_best_hit').hide();
			}
			else if(result =='month_best_likes'){
				$('.month_best_like').show();
				$('.week_best_like').hide();
				$('.week_best_hit').hide();
				$('.month_best_hit').hide();
			}
			else{
				$('.month_best_hit').show();
				$('.week_best_like').hide();
				$('.week_best_hit').hide();
				$('.month_best_like').hide();
			}
	
		}); 
	}); 

})

