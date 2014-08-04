$(document).ready( function() {

	/**
	 * Adds a user by loading a form and allowing you to fill it out.
	 */
	$('#add_user').on('click', function() {
		$('#add_user').hide();
		$('#edit_user').load('add_user.php?&jq=true', function() {
			$(this).fadeIn(400, function() {
				// Scroll Down
				var top = $(this).offset().top;
				$('html, body').animate({scrollTop: top}, 800);
			});
		});
		return false;
	});
	$('a#cancel').on('click', function() {
		$('.user_edit_section').fadeOut();
		return true;
	});


	/**
	 * Edits an existing user, again by loading an external form
	 * allowing you to submit modifications to users.
	 */
	$('.edit').on('click', function() {
		$('#add_user').hide();
		// Grab the ID this uses a HTML custom data type.
		var id = $(this).parent().parent().data('id');
		$('#edit_user').load('edit_user.php?id='+id+'&jq=true', function() {
			$(this).fadeIn(400, function() {
				// Scroll Down
				var top = $(this).offset().top;
				$('html, body').animate({scrollTop: top}, 800);
			});
		});
		return false;
	});

	/**
	 * Calls a function allowing you to delete an account.
	 *
	 * SEE FUNCTION perform_task() TO MAKE CHANGES
	 */
	$('#delete_account').on('click', function() {
		perform_task($(this));
		return false;
	});

	/**
	 * Allows the administrator to reset a users password.
	 *
	 * SEE FUNCTION perform_task() TO MAKE CHANGES.
	 */
	$('#reset_password').on('click', function() {
		perform_task($(this));
		return false;
	});

	/**
	 * Allows the admin to create a user from the admin panel.
	 * When the admin has created a user successfully by default they
	 * will be redirected to 'manage_users.php'
	 *
	 * @see location.href = "manage_users.php";
	 *
	 * To change this to another location simply change like so:
	 * location.href = "MY_CHANGE_PAGE.php";
	 */
	$('#create').on('click', function() {
		var firstname = $('input[name=firstname]').val(),
				lastname = $('input[name=lastname]').val(),
				username = $('input[name=username]').val(),
				email = $('input[name=email]').val(),
				redirect = $('input[name=redirect]').val(),
				password = $('input[name=password]').val(),
				feedback = $('#feedback'),
				status = $('#status').val(),
				csrf_field = $('input[name=csrf_field]').val();
		feedback.fadeOut();
		if ( firstname === "" || lastname === "" || username === "" || email === "" || redirect === "" ) {
			feedback.addClass('error alert').text('Please fill out all required fields.').fadeIn();
			nice_scroll();
			return false;
		}
		$.ajax({
			type: 'POST',
			url: 'process.php',
			dataType: 'json',
			data: {
				firstname: firstname,
				lastname: lastname,
				username: username,
				email: email,
				redirect: redirect,
				password: password,
				status: status,
				task: 'create_from_admin',
				csrf_field: csrf_field
			}, success: function(data) {
				feedback.removeClass().addClass( (data.error === true) ? 'alert error':'alert success' ).text(data.message).fadeIn();
				if ( data.error === false )
					location.href = "manage_users.php";
				else nice_scroll();
			}
		});
		return false;
	});

	$('#update_profile').on('click', function() {
		var firstname = $('input[name=firstname]').val(),
				lastname = $('input[name=lastname]').val(),
				username = $('input[name=username]').val(),
				email = $('input[name=email]').val(),
				redirect = $('input[name=redirect]').val(),
				password = $('input[name=password]').val(),
				feedback = $('#feedback'),
				id = $('input[name=id]').val(),
				csrf = $('input[name=csrf_field]').val();

		feedback.fadeOut();
		if ( id === "" || firstname === "" || lastname === "" || username === "" || email === "" || redirect === "" ) {
			feedback.addClass('error alert').text('Please fill out all required fields.').slideToggle();
			return false;
		}

		$.ajax({
			type: 'POST',
			url: 'process.php',
			dataType: 'json',
			data: {
				task: 'user_update_profile',
				id: id,
				csrf_field: csrf,
				firstname: firstname,
				lastname: lastname,
				username: username,
				email: email,
				password: password
			}, success: function(data) {
				feedback.removeClass().addClass( (data.error === true) ? 'alert error':'alert success' ).text(data.message).slideToggle();
				nice_scroll();
			}
		});
		return false;

	});

	/**
	 * Saves changes to users made from the admin panel.
	 *
	 * @see location.href = "manage_users.php";
	 *
	 * To change this to another location simply change like so:
	 * location.href = "MY_CHANGE_PAGE.php";
	 */
	$('#save').on('click', function() {

		var firstname = $('input[name=firstname]').val(),
				lastname = $('input[name=lastname]').val(),
				username = $('input[name=username]').val(),
				email = $('input[name=email]').val(),
				redirect = $('input[name=redirect]').val(),
				password = $('input[name=password]').val(),
				feedback = $('#feedback'),
				id = $('input[name=id]').val(),
				csrf = $('input[name=csrf_field]').val(),
				status = $('#status').val();

		feedback.fadeOut();
		if ( id === "" || username === "" || email === "" || redirect === "" ) {
			nice_scroll();
			feedback.removeClass().addClass('alert error').text('Please fill out the required fields!').slideToggle();
			return false;
		}
		$.ajax({
			type: 'POST',
			url: 'process.php',
			dataType: 'json',
			data: {
				id: id,
				csrf_field: csrf,
				status: status,
				firstname: firstname,
				lastname: lastname,
				username: username,
				email: email,
				redirect: redirect,
				password: (password === "")?"":password,
				task: 'update_user_from_admin'
			}, success: function(data) {
				nice_scroll();
				feedback.removeClass().addClass( (data.error === true) ? 'alert error':'alert success' ).text(data.message).slideToggle();
				if ( data.error === false )
					location.href = "manage_users.php";
			}
		});
		return false;
	});
});

function nice_scroll() {
	$('body, html').animate({
		scrollTop: 0
	}, 800);
	return false;
}

/**
 * Peforms multimple tasks
 *
 */
function perform_task(obj) {
	var id = obj.attr('href'),
				csrf = $('input[name=csrf_field]').val(),
				$this = $(this),
				feedback = $('#feedback');

		feedback.fadeOut();

		// Show confirmation
	if (confirm('Are you sure? This action can\'t be undone!')) {
		$.ajax({
			type: 'POST',
			url: 'process.php',
			dataType: 'json',
			data: {
				edit_or_delete: id,
				csrf_field: csrf
			}, success: function(data) {
				// Check to see if we have any redirect
				feedback.removeClass().addClass( (data.error === true) ? 'alert error':'alert success' ).text(data.message).slideToggle();
				nice_scroll();
				if ( data.redirect )
					location.href = data.redirect;
			}
		});
	}
}