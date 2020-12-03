$(document).ready(function(){
	$(".close_mess").click(function(){
		let data = [];
		let user = [];
        user["name"] = "face";
        user["value"] = $(this).data("user-id");
        data.push(user);
		$.ajax({
            type: "POST",
            url: "/bitrix/components/deus/news.detail/templates/user_profile/close_message.php",
            data: data,
            success: function (responseData) {
            	//console.log(responseData);
            	$(".state-account_success").detach();
            }
        });
	});
});