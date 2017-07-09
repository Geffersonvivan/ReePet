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
	createFormAjax();
	searchCodeFormAjax();
}

function headerScroll() {
	var checkAndUpdateHeaderClass = function(){
		var scrollTop = pageYOffset;
		if(scrollTop){
			document.querySelector(".main-header__nav").classList.add('main-header__nav--fixed');
		}else{
			var headerFixed = document.querySelector(".main-header__nav--fixed");
			if(headerFixed) headerFixed.classList.remove('main-header__nav--fixed');
		}
	};

	checkAndUpdateHeaderClass();
	window.addEventListener('scroll', function(){checkAndUpdateHeaderClass()});
}

function createFormAjax() {
	var $form = $("#create-form");
	$form.on('submit', function(event){
		event.preventDefault();
    var inputs = $form.find("[name]");
		var post = {};
		$.each(inputs, function(item){
			post[$(inputs[item]).attr('name')] = $(inputs[item]).val();
			$(inputs[item]).val("");
		})
		post.action = "create";
		$.post('controllers/UserController.php', post)
			.done(function(data){
				bindEvent("createUserDone", {code: data})
			});
	});
}

function searchCodeFormAjax() {
	var $form = $("#search-code-form");
	$form.on('submit', function(event){
		event.preventDefault();
    var inputs = $form.find("[name]");
		var post = {};
		$.each(inputs, function(item){
			post[$(inputs[item]).attr('name')] = $(inputs[item]).val();
		})
		post.action = "searchCode";
		$.post('controllers/UserController.php', post)
			.done(function(data){
				bindEvent("searchCodeDone", data)
			});
	});
}

function bindEvent(event, data){
	$("[bind-show="+event+"]").show();
	$("[bind-hide="+event+"]").hide();
	$("[bind-print="+event+"]").each(function(){
		$(this).text(eval("data."+$(this).text()));
	});
}
