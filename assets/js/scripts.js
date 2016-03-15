$(document).ready(function() {
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
});

$('.dropdown').hover(function(){
	$('.dropdown-toggle',this).trigger('click');
});