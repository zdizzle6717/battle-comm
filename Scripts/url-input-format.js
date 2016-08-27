$(document).ready(function () {
$("#user_facebook").change(function() {
	if($('#user_facebook').val() == '') {
		$('#user_facebook').val() == '' }
	else if (!/^http:\/\//.test(this.value)) {
		this.value = "http://" + this.value;
	}
});
$("#user_twitter").change(function() {
	if($('#user_twitter').val() == '') {
		$('#user_twitter').val() == '' }
	else if (!/^http:\/\//.test(this.value)) {
		this.value = "http://" + this.value;
	}
});
$("#user_instagram").change(function() {
	if($('#user_instagram').val() == '') {
		$('#user_instagram').val() == '' }
	else if (!/^http:\/\//.test(this.value)) {
		this.value = "http://" + this.value;
	}
});
$("#user_google_plus").change(function() {
	if($('#user_google_plus').val() == '') {
		$('#user_google_plus').val() == '' }
	else if (!/^http:\/\//.test(this.value)) {
		this.value = "http://" + this.value;
	}
});
$("#user_youtube").change(function() {
	if($('#user_youtube').val() == '') {
		$('#user_youtube').val() == '' }
	else if (!/^http:\/\//.test(this.value)) {
		this.value = "http://" + this.value;
	}
});
$("#user_twitch").change(function() {
	if($('#user_twitch').val() == '') {
		$('#user_twitch').val() == '' }
	else if (!/^http:\/\//.test(this.value)) {
		this.value = "http://" + this.value;
	}
});
$("#user_website").change(function() {
	if($('#user_website').val() == '') {
		$('#user_website').val() == '' }
	else if (!/^http:\/\//.test(this.value)) {
		this.value = "http://" + this.value;
	}
});
});
