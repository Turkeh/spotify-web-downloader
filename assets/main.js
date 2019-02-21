// Submit download form
function submit(){

    // Do validation
    if (!validateForm())
        return false;

    $('#submit-button').addClass('disabled');
    $('#download-input').addClass('disabled');

    loader('Preparing File.', '', true);

	var serializedData = $('#download-form').serialize();

    $.ajax({
        url: application_url+"/PostHandler.php",
        type: "POST",
        dataType: "JSON",
        data: serializedData,
        success: function( data ) {

        	if (data.status == 'Success' && data.output.length > 0 ) {
                loader('Success! Downloading file');
                $('.close-loader').css('display', 'block');
                $('#submit-button').removeClass('disabled');
                $('#download-input').removeClass('disabled');
            }
            else
        		loader('Sorry there was an error preparing your file', 'Please try again.', true);

            if (data.filepath)
                window.location.href = data.filepath;
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

function loader(mainContent, subContent = '', persistent = false) {

    $('.loading').css('visibility', 'visible');

    $('.loader-text').html(mainContent);

    if (subContent != '')
        $('.loader-subtext').html(subContent);
    else
        $('.loader-subtext').html('');

    if (!persistent) {
        setTimeout(function(){ 
            $('.loading').css('visibility', 'hidden');
            $('.close-loader').css('display', 'none');
        }, 5000);
    }
}

function closeLoader() {
    $('.loading').css('visibility', 'hidden');
}
