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

		$stmt    = $pdo->prepare( 'SELECT rgt from comment WHERE id=?' );
		$stmt->execute( array( $parent_id ) );
		$stmt=$stmt->fetch();
		$myRight = intval($stmt["rgt"])-1;
		var_dump( $myRight );
		$stmt = $pdo->prepare( 'UPDATE comment SET rgt=rgt+2 where rgt> ?' );
		$stmt->execute( array( $myRight ) );

		$stmt = $pdo->prepare( 'UPDATE comment SET lft=lft+2 where lft> ?' );
		$stmt->execute( array( $myRight ) );

		$stmt = $pdo->prepare( 'INSERT INTO comment(`comment_name`,`lft`,`rgt`,`parent_id`,`text`) VALUES(?, ?,?,?,?)' );
		$stmt->execute( array( $name, $myRight + 1, $myRight + 2, $parent_id, $text ) );


		Database::disconnect();
		header( "Location: index.php" );
	}
}

