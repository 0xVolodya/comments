<?php
require 'database.php';

if ( ! empty( $_POST ) ) {
	$name  = $_POST['name'];
	$text  = $_POST['text'];
	$valid = true;
	$parent_id = ( $_POST['reply_id'] == null ||
	               $_POST['reply_id'] == "" ) ? 1 : $_POST['reply_id'];


	if ( $valid ) {
//		echo $name . $text;

		$pdo = Database::connect();
		$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$stmt = $pdo->prepare( 'UPDATE comment SET comment_name=?,text=? where id=?' );
		$stmt->execute( array( $name, $text, $parent_id) );


		Database::disconnect();
		header( "Location: index.php" );
	}
}

