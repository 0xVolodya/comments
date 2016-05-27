<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nested comments</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href=style.css>

	<script src="js/jquery-1.12.4.js"></script>
	<script type="text/javascript" src="js/comments.js"></script>
</head>
<body>

<div class="container">
	<div class="form_wrapper well ">
		<form class="form-horizontal" action="create.php" method="post">
			<h4 class="form-heading">Leave a comment</h4>

			<div class="col-md-8 form-group ">
				<label class="sr-only">Name</label>
				<div class="controls">
					<input name="name" type="text" placeholder="Name"
					       value="" class="form-control">
				</div>
			</div>
			<div class="col-md-8 form-group ">
				<label class="sr-only">Comment</label>
				<div class="controls">
					<textarea name="text" type="text" placeholder="Comment"
					       value="" class="form-control"></textarea>
				</div>
			</div>
			<div>
				<input type="hidden" name="reply_id" class="reply_id"  value="">
			</div>

			<div class="col-md-12 form-group text-right">
				<button type="submit" class="btn btn-success">Submit</button>
				<a class="btn btn-primary back_button" href="">Back</a>
			</div>
		</form>
	</div>


	<?php
	require( "comments.php" );
	?>
</div>


</body>
</html>