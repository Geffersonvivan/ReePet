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
		var scrollTop = document.body.scrollTop;
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
				$("#created-code-modal").modal();
				$("#created-code-modal-value").html(data);
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
				$valueContent = $("#search-code-value");
				var binds = $valueContent.find("[print-bind=searchCodeDone]");
				$.each(binds, function(item){
					var $bind = $(binds[item]);
					var value = eval($bind.text());
					$bind.text(value);
				});
				$("[print-show=searchCodeDone]").show();
			});
	});
}
