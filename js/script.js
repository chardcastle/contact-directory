var app = app || {};

app.contactsList = {

	init: function() {

		// Get all data
		// 
		var contacts = $.ajax({
			method: 'GET',
			url: 'http://localhost:8000/contacts/',
			error: function(error) {
				console.error('There was a fail');
			}
		});
		var favourites = $.ajax({
			method: 'GET',
			url: 'http://localhost:8000/contacts/favourites/',
			error: function(error) {
				console.error('There was a fail');
			}
		});

		// When both ajax requests have been resolved
		// 
		$.when(contacts, favourites)
		.then(function(contacts, favourites) {

			// Remove old contacts and favourite data
			$('.stale').remove();

			// Refresh contacts list
			// 
			$(contacts[0]).each(function(i, item) {
				var record = $('#contactList .tpl').clone();
				record
				.find('li.name')
					.text(item.forename + ' ' + item.surname)
				.end()
				.find('li.email')
					.text(item.email)
				.end()
				.find('.btn')
					.on('click', function(e){
						e.preventDefault();
						app.contactsList.addToFavourites(item.email);
					})
				.end()
				.removeClass('tpl')
				.removeClass('hidden')
				.addClass('stale')
				.appendTo('#contactList');
			});

			// Refresh favourites
			// 
			$(favourites[0]).each(function(i, item) {

				var record = $('#favouriteList .tpl').clone();
				record
				.find('li.name')
					.text(item.forename + ' ' + item.surname)
				.end()
				.find('li.email')
					.text(item.email)
				.end()
				.find('.btn')
					.on('click', function(e){
						e.preventDefault();
						alert(item.email);
					})
				.end()
				.removeClass('tpl')
				.removeClass('hidden')
				.addClass('stale')
				.appendTo('#favouriteList');
			});
		})		
	},
	addEvents: function()
	{
		// Handle creation of new contacts
		// 
		$('form.newContactForm').submit(function(e) {
			e.preventDefault();
			$.ajax({
				method: 'POST',
				data: $('form.newContactForm').serialize(),
				url: 'http://localhost:8000/contact/',
				success: function() {
					alert('Contact added');
					$('#newContactModal').modal('hide');
				},
				error: function(error) {
					console.error('There was an error');
				}
			})
			.done(function() {
				app.contactsList.init();
			});			
		});

		// Clear form fields when the modal is closed
		// 
		$('#newContactModal').on('hidden.bs.modal', function () {
		  $('#newContactModal input:not(.btn), #newContactModal textarea').val('');
		});

	},

	addToFavourites: function(email) {
		
			$.ajax({
				method: 'POST',
				data: {'email' : email},
				url: 'http://localhost:8000/contact/favourite/',
				success: function() {
					alert('Contact added to favourite');
				},
				error: function(error) {
					console.error('There was an error');
				}
			})
			.done(function() {
				app.contactsList.init();
			});			
	}
}