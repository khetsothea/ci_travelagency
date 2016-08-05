$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
});

$('.dropdown').hover(function(){
	$('.dropdown-toggle',this).trigger('click');
});

$('.carousel').carousel({
    interval: 5000 //changes the speed
});