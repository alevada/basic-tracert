<?php

	require_once 'connection.php';

	$result = $conn->query("SELECT * FROM traces ORDER BY id DESC, date desc LIMIT 20");
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
		<div class="container">
			<h2>Recent traces <a href="index.php" class="add">Add new</a></h2>
			
			<?php
				if ($result && $result->num_rows > 0) {
					$nr = 1;
				?>
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Url</th>
								<th scope="col">Response</th>
								<th scope="col">Date</th>
							</tr>
						</thead>
						<tbody>
							<?php while($row = $result->fetch_assoc()) { ?>

								<tr>
									<th scope="row"><?= $nr++; ?></th>
									<td><?= $row['name']; ?></td>
									<td><pre><?= $row['response']; ?></pre></td>
									<td>
										<?= date("F jS, Y", strtotime($row['date'])); ?><br/>
										<?= date("H:m:s", strtotime($row['date'])); ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
					<?php
				} else { ?>
					<span>No Results</span>
				<?php } ?>
		</div>
	</body>
</html>