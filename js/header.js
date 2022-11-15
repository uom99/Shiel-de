$(function(){

  $('.navbar-nav>li>a').click(function(){
    $('.navbar-nav>li>a').removeClass('text-primary')
    $('.navbar-nav>li>a').addClass('text-opacity-50')
    $(this).removeClass('text-opacity-50')
    $(this).removeClass('text-secondary')
    $(this).addClass('text-dark')
    
})
})
  
