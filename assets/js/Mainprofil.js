$(document).ready(function () {

	$("#flip_password").click(function () {

		$("#panel").slideDown("slow");
		$(this).attr("disabled", true);
		$("#update_email").attr("disabled", true);

	});

	$("#cancel_change_password").click(function () {

		$("#panel").fadeOut();
		$('#flip_password').removeAttr("disabled");
		$("#update_email").removeAttr("disabled");
	});

});
