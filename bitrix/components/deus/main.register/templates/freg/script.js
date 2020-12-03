$(document).ready(function(){
	function updateURL(param) {
	    if (history.pushState) {
	        var baseUrl = window.location.protocol + "//" + window.location.host + '/freg/';
	        var newUrl = baseUrl+param+"/";
	        history.pushState(null, null, newUrl);
	    }
	    else {
	        console.warn('History API не поддерживается');
	    }
	}
	$("input[name='REGISTER[EMAIL]']").on('input', function(){
		var login = $(this).val();
		$("input[name='REGISTER[LOGIN]']").val(login);
	});
	$("input[name='FACE']").on('change', function(){
		var valueField = $(this).val();
		$(".face_field").toggleClass("hidden_field");
		param = valueField.toLowerCase();
		updateURL(param);
		$("form[name=regform]").attr("action", "/freg/"+param+"/");
	});
	$(".form_title_reg .help").click(function(){
		$.fancybox.open({
            src: '#form_title_reg_description',
        });
	});
	$(".help.password_reg_description").click(function(){
		$.fancybox.open({
            src: '#password_reg_description',
        });
	});
	
	$(".sign_in_alert span").click(function(){	
		$.fancybox.open({
            src: '#sign_in_alert_text',
        });
	});
	$(".bx-auth-reg form").submit(function(){
		// $("#password").removeClass("error");
		// var successForm = true;
		// if(!$("#pwdMeter").hasClass("verystrong")){
		// 	successForm = false;
		// 	$("#pwdMeter").addClass("1");
		// }
		// if(!successForm){
		// 	if($("#pwdMeter").hasClass("strong")){
		// 		successForm = true;
		// 		$("#pwdMeter").addClass("3");
		// 	}
		// 	$("#pwdMeter").addClass("2");
		// }
		// $("#pwdMeter").addClass("4_"+successForm);
		// if(!successForm){
		// 	$("#password").addClass("error");
		// 	$.fancybox.open({
	 //            src: '#password_reg_description',
	 //        });
		// }
		// $("#password").removeAttr("disabled");
		// var pass = $('input[name="REGISTER[PASSWORD]"]').val();
		// var confirmPass = $('input[name="REGISTER[CONFIRM_PASSWORD]"]').val();
		// $('input[name="REGISTER[CONFIRM_PASSWORD]"]').removeClass("error");
		// if(confirmPass != pass){
		// 	$('input[name="REGISTER[CONFIRM_PASSWORD]"]').addClass("error");
		// 	successForm = false;
		// }
		// return successForm;
	});
	
    $("#password").pwdMeter();
});