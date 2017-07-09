(function ($) {
	$('a[href^=#]').smoothScroll({
		offset: -80,
	});
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
	bindEvents();
	forgetedCodeForm();
	$("#loading").fadeOut(300);
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
				data.whatsappLink = "https://api.whatsapp.com/send?1=pt_BR&phone=55" + (data.whatsapp.replace(/\s|[(]|[)]|[-]/g, ""));
				data.emailLink = "mailto:" + data.email;
				console.log(data.whatsappLink);
				bindEvent("searchCodeDone", data)
			});
	});
}

function forgetedCodeForm(){
	var $form = $("#forgeted-code-form");
	$form.on('submit', function(event){
		event.preventDefault();
    var inputs = $form.find("[name]");
		var post = {};
		$.each(inputs, function(item){
			post[$(inputs[item]).attr('name')] = $(inputs[item]).val();
		})
		post.action = "forgetedCode";
		$.post('controllers/UserController.php', post)
			.done(function(data){
				bindEvent("showForgetCodeDone", {code: data})
			});
	});
}

function bindEvent(event, data){
	event = event.replace(/_/g, "");
	$("[bind-show*=_"+event+"_]").show();
	$("[bind-hide*=_"+event+"_]").hide();
	$("[bind-print*=_"+event+"_]").each(function(){
		$(this).html(getBind($(this).text()));
	});
	$("[bind-param*=_"+event+"_]").each(function(){
		var content = $(this).attr("bind-param").replace("_"+event+"_:", "");
		var param = content.split(":")[0];
		var value = getBind(content.replace(/^.+:/,""));
		console.log(param, value);
		$(this).attr(param, value);
	});

	function getBind(key){
		return eval("data."+key);
	}
}

function bindEvents(){
	$("[bind-click]").bind('click', function(){
		triggetAllEvents($(this).attr('bind-click'));
	})
	triggetAllEvents($("[bind-init]").attr('bind-init'));

	function triggetAllEvents(content) {
		content.split("_").filter(function(item){return item}).forEach(function(item){
			bindEvent(item);
		});
	}
}
