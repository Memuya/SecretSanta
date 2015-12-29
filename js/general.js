$(document).ready(function() {

	//Add another restriction text field
	$("#add-restriction").click(function() {
		input = $('<input type="text" name="restrictions[]" placeholder="Person1, Person2" class="restrictions">');

		input.hide().insertBefore($(this)).fadeIn(100);

		return false;
	});

	//Remove a restriction text field
	$("#remove-restriction").click(function() {
		//Get the closest restriction element
		input = $(this).prev().prev();

		//Remove if it is not the last one
		if($('.restrictions').length != 1) {
			input.fadeOut(100, function() {
				input.remove();
			});
		}

		return false;
	});

	//AJAX call
	$("#match").click(function() {
		$("#matches").html('<img src="img/ajax-loader.gif">');
		
		$.ajax({
			type: "POST",
			url: "ajax/match.php",
			data: {
				users: $("#users").val(),
				restrictions: $('input[name="restrictions[]"]').map(function(){
					return $(this).val();
				}).get()
			},
			success: function(data) {
				$("#matches").hide().html(data).fadeIn();
			},
			error: function() {
				console.log('AJAX request failed.');
			}
		});

		return false;
	});

	//Toggle help box
	$("#help-btn").click(function() {
		$("#help").slideToggle();
		return false;
	});
	
});