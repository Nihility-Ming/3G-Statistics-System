// preload image
var url = 'application/views/';
new Image().src = url + 'images/index_23_hover.png';

$(function() {
	
	// change submit photo
	var $submit = document.getElementById('submit');
	$submit.onmouseover = function () {
		this.src = url + 'images/index_23_hover.png';
	}
	$submit.onmouseout = function () {
		this.src = url + 'images/index_23.png';
	}
	
	// change captcha
	$('p img').click(function(){
		var $this = $(this);
		$.post('index.php/welcome/code' + '?fdsf=' +Math.random(),function(data){
			$this.attr('src',data);
		});
	}).mouseover(function(){
		var $this = $(this);
		$this.css({'cursor':'pointer'});	
		$this.attr('title','点击刷新验证码');
	});
	
	$('.box').hide().fadeIn(1000); // box's animate
	
}); //end ready