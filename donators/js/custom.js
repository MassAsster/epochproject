jQuery.support.placeholder = (function(){
  var i = document.createElement('input');
  return 'placeholder' in i;
})();

$(document).ready( function() {

	// Does it support placeholders?
	if ( $.support.placeholder ) {
		// Let the users know what to enter.
		$('.input-block > label').hide();
	}

	// Global Variables
	feedback = $('#feedback');

	// Hide the JS message
	$('.no-js').hide();

	/**
	 * Called when the user forgets their password.
	 */
	$('#forgot_password').on('click', function() {
		// Some variables.
		var email = $('input[name=email]').val();
		feedback.fadeOut();
		if ( email === "" ) {
			feedback.removeClass().addClass('alert error').text('Please fill out all required fields!').slideToggle();
			return false;
		}
		$.ajax({
			type: 'POST',
			url: 'process.php',
			dataType: 'json',
			data: {
				email: email,
				task: 'forgot_password'
			}, success: function(data) {
				feedback.removeClass().addClass((data.error === true) ? 'alert error' : 'alert success').text(data.message).slideToggle();
			}
		});
		return false;
	});

	$('#save_settings').on('click', function() {
		feedback.fadeOut();
		var allow_reg = parseInt($('#registration').val()),
				location = $('#location').val();
		$.post('process.php', {
			allow_reg: allow_reg,
			location: location,
			task: 'save_settings'
		}, function( data ) {
			if ( data.error === false ) {
				// We have no errors.
				feedback.removeClass().addClass('alert success').text(data.message).slideToggle();
			}
		}, 'json');
		return false;
	});

	/**
	 * Called when the user registers a new account.
	 */
	$('#register').on('click', function() {
		// Some variables.
		var username = $('input[name=username]').val(),
				password = $('input[name=password]').val(),
				email = $('input[name=email]').val(),
				captcha = $('input[name=captcha]').val();
				feedback.fadeOut();
		// Some validation.
		if ( username === "" || password === "" || email === "" || captcha === "") {
			feedback.removeClass().addClass('alert error').text('Please fill out all required fields!').slideToggle();
			return false;
		}
		$.ajax({
			type: 'POST',
			url: 'process.php',
			dataType: 'json',
			data: {
				username: username,
				password: password,
				email: email,
				captcha: captcha,
				task: 'new_user'
			}, success: function(data) {
				feedback.removeClass().addClass((data.error === true) ? 'alert error' : 'alert success').text(data.message).slideToggle();
			}
		});
		return false;
	});

	/**
	 * When the user clicks on the login button.
	 */
	$('#login').on('click', function(e) {
		// Some variables
		var username = $('input[name=username]').val(),
				password = $('input[name=password]').val(),
				csrf = $('input[name=csrf_field]').val(),
				load = $('.form_loader');
		feedback.slideToggle();
		load.fadeIn();
		// Check to see if any empty values..
		// I mean c'mon.. Why disturb PHP?
		if ( username === "" || password === "" || csrf === "" ) {
			feedback.removeClass().addClass('alert error').text('Please enter your username and or password!').slideToggle();
			load.fadeOut();
			return false;
		}
		// Post the data and validate it.
		$.ajax({
			type: 'post',
			url: 'process.php',
			dataType: 'json',
			data: {
				username: username,
				password: password,
				csrf_field: csrf,
				task: "login"
			}, success: function(data) {
				load.fadeOut();
				feedback.removeClass().addClass( (data.error === false) ? 'alert success' : 'alert error' ).html(data.message).fadeIn();
				if (data.error === false) {
					location.href = data.redirect;
				}
			}, error: function(XMLHttpRequest, textStatus, errorThrown) {
				feedback.removeClass().addClass('error').text('Something went wrong. Please check the console for more information.').fadeIn();
				load.fadeOut();
				console.log(XMLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);
				// console.log(XMLHttpRequest.responseText);
			}
		});
		return false;
	});

	$('#forgot-password').on('click', function() {
		// Some variables.
		var forgotEmail = $('input#forgot-email').val(),
				feedback = $('#feedback'),
				load = $('#loading');

		feedback.fadeOut();
		load.fadeIn();
		if (forgotEmail === "") {
			load.fadeOut();
			feedback.removeClass().addClass('error').text('Please enter your email so that I can work with it!').fadeIn();
			return false;
		}
		$.ajax({
			type: 'post',
			url: 'process.php',
			dataType: 'json',
			data: {
				forgotEmail: forgotEmail
			}, success: function(data) {
				load.fadeOut();
				feedback.removeClass().addClass( (data.error === false) ? 'success' : 'error' ).text(data.message).fadeIn();
			}, error: function(XMLHttpRequest, textStatus, errorThrown) {
				feedback.removeClass().addClass('error').text('Something went wrong. Please check the console for more information.').fadeIn();
				load.fadeOut();
				console.log(XMLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});
		return false;
	});

	/** TODO: Do this **/
	$('#renew-password').on('click', function() {
		var passwordOne = $('input#re-password').val(),
				passwordTwo = $('input#re-password-2').val(),
				emailReset = $('input#email-reset').val(),
				resetCode = $('input#reset-code').val(),
				feedback = $('#feedback'),
				load = $('#loading');

		feedback.fadeOut();
		load.fadeIn();

		if ( (passwordOne === "") || (passwordTwo === "") || (emailReset === "") || resetCode === "") {
			load.fadeOut();
			feedback.removeClass().addClass('error').text('Please enter your new password, two times!').fadeIn();
			return false;
		}

		$.ajax({
			type: 'post',
			url: 'process.php',
			dataType: 'json',
			data: {
				passwordOne: passwordOne,
				passwordTwo: passwordTwo,
				emailReset: emailReset,
				resetCode: resetCode
			}, success: function(data) {
				load.fadeOut();
				feedback.removeClass().addClass( (data.error === false) ? 'success' : 'error' ).text(data.message).fadeIn();
			}, error: function(XMLHttpRequest, textStatus, errorThrown) {
				feedback.removeClass().addClass('error').text('Something went wrong. Please check the console for more information.').fadeIn();
				load.fadeOut();
				console.log(XMLHttpRequest);
				console.log(textStatus);
				console.log(errorThrown);
			}
		});

		return false;
	});

});