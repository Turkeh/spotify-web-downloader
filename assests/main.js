// Submit download form
function submit(){

    // Do validation
    if (!validateForm())
        return false;

	var serializedData = $('#download-form').serialize();

	$('.loading').css('visibility', 'visible');

    $.ajax({
        url: application_url+"/PostHandler.php",
        type: "POST",
        dataType: "JSON",
        data: serializedData,
        success: function( data ) {

        	console.log('Very nice, how much?');

        	if (data.output[3] == 'INFO: Applying metadata')
        		window.alert('Download Complete');
        	else
        		window.alert('Download Error');

			$('.loading').css('visibility', 'hidden');

        }
    });

}

// Update download type
function downloadType(type) {

	$('.download-type').html(type);
	$('#download-type-input').val(type);

	var placeholder = 'The Sentinel - Hilltop Hoods';

	if (type == 'link') {
		placeholder = 'https://open.spotify.com/track/1oRgR3JlKRy37lxk7Bsh5a?si=gjjJjggVSeyxz-zwfMc7vA';
	}

	$('#download-input').attr('placeholder', placeholder);

}

function validateForm() {

    var valid = true;

    // Reset validations
    $('.validation').removeClass('is-invalid');

    if ($('#download-input').val() == '') {
        $('#download-input').addClass('is-invalid');

        valid = false;
    }


    return valid;
}