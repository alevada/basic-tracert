
<?php

	require_once 'connection.php';

	$output = null;

	if (isset($_POST) && isset($_POST['host'])) {
		$host = trim($_POST['host']);

		if ($host != '') {
			//2 = stderror / 1 = std output / & = what follows is a file descriptor, not a filename / > redirect in direactia asta ->
			$output = shell_exec('tracert '.$host.' 2>&1');

			$conn->query("INSERT INTO traces (`name`, `response`, `date`) VALUES ('".$host."', '".$output."', '".date('Y-m-d h:i:s')."')");
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="styles.css" rel="stylesheet" id="bootstrap-css">
	</head>
	<body>
		<form method="post">
			<div class="titlecontainer">
				<h2>Tracert<a href="results.php" class="add">Previous lookups</a></h2>
			</div>
			<div class="containerr">
 				<div class="input-group mb-3">
					<label for="text" class="host">Host name or IPv4 address: </label>
					<input type="text" id="hostInput" name="host" required class="form-control" aria-label="Host name or IPv4 address: " aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="submit" id="submitButton">Go</button>
					</div>
				</div>
			</div>
			<div class="pre">
				<?php if (!is_null($output)) {
					echo "<pre>".$output."</pre>";
				}?>
			</div>
		</form>
	</body>

	<script type="text/javascript">
		// se incarca documentul
		$(document).ready(function() {
			$('#submitButton').prop('disabled', true);
			// keyup = cand ridici degetul de pe tasta
		    $("#hostInput").keyup(function(e) {
		    	var inputValue = $(this).val();
				$("#hostInput").val($.trim(inputValue));
				// verific daca 
				$('#submitButton').prop('disabled', ($("#hostInput").val() == ''));
		    });
		});
	</script>
</html>

