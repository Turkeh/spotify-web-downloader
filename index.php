<?php

require($_SERVER['DOCUMENT_ROOT'].'/config.php');

function __autoload($class_name) {
    if(file_exists(APPLICATION.'/'.$class_name . '.php')) {
        require_once(APPLICATION.'/'.$class_name . '.php');    
    } else {
        throw new Exception("Unable to load ".APPLICATION_URL."/$class_name.");
    }
}

$structure = new Structure();
$downloadLocations = $structure->getDownloadLocations();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Loader . Fatherbean</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script>
		// Globals
		var application_url = "<?php echo APPLICATION_URL; ?>";
	</script>

</head>
<body>

	<div class="container">

		<div class="main">
			
			<div class="loading">
				
				<h3>Downloading Now..</h3>

			</div>

			<div class="form-container">
				
			<form action="" method="POST" id="download-form">

				<div class="form-group">

					<label for="spotify-song">Spotify <span class="download-type">Song</span></label>
					<div class="input-group">

						<input type="text" name="download-input" id="download-input" class="form-control validation" aria-label="Download input" placeholder="Hilltop Hoods - The Sentinel">
						<input type="hidden" name="download-type" id="download-type-input" value="song">

						<div class="input-group-append">
						<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Download Type</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="javascript: onclick(downloadType('song'));">Song</a>
								<a class="dropdown-item" href="javascript: onclick(downloadType('link'));">Link</a>
							</div>
						</div>

						<div class="invalid-feedback">
							Please enter your <span class="download-type">song</span>.
						</div>
					</div>

				</div>

				<div class="form-group">

					<label for="download-location">Download Location</label>
					<select name="download-location" id="download-location" class="form-control">
						
						<?php
							foreach ($downloadLocations as $location) { 
								$select = '';
								if ($location == 'Other')
									$select = 'selected';
						?>
							<option value="<?php echo $location; ?>" <?php echo $select;?>><?php echo $location; ?></option>
						<?php 
							}
						?>

					</select>

				</div>

				<span onclick="submit()" class="btn btn-primary">Submit</span>
			</form>

			</div>

		</div>

	</div>

	<script src="<?php echo ASSETS_URL;?>/main.js"></script>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</body>
</html>
