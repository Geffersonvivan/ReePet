(function ($) {
	$('ul.dl-menu li a').smoothScroll();

	new WOW().init();
})(jQuery);

$(function(){
	var SPMaskBehavior = function (val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
		onKeyPress: function(val, e, field, options) {
			field.mask(SPMaskBehavior.apply({}, arguments), options);
		}
	};
	$('.sp_celphones').mask(SPMaskBehavior, spOptions);
});

onload = function(){
	headerScroll();
}

function headerScroll() {
	window.addEventListener('scroll', function(){
		var scrollTop = document.body.scrollTop;
		if(scrollTop){
			document.querySelector(".main-header__nav").classList.add('main-header__nav--fixed');
		}else{
			document.querySelector(".main-header__nav--fixed").classList.remove('main-header__nav--fixed');
		}
	});
}
