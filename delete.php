<?php


require 'database.php';


if(!empty($_GET['id'])){

	$id=intval($_GET['id']);
	$pdo = Database::connect();
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$stmt    = $pdo->prepare( 'SELECT rgt from comment WHERE id=?' );
	$stmt->execute( array( $id ) );
	$stmt=$stmt->fetch();
	$myRight =intval($stmt['rgt']);

	$stmt    = $pdo->prepare( 'SELECT lft from comment WHERE id=?' );
	$stmt->execute( array( $id ) );
	$stmt=$stmt->fetch();
	$myLeft =intval($stmt['lft']);

	$width=$myRight-$myLeft+1;
	var_dump($id, $myLeft, $myRight ,$width);

	$stmt = $pdo->prepare( 'DELETE from comment where lft BETWEEN ? and ?' );
	$stmt->execute( array( $myLeft, $myRight ) );

	$stmt = $pdo->prepare( 'UPDATE comment SET rgt=rgt-? where rgt> ?' );
	$stmt->execute( array( $width,$myRight ) );

	$stmt = $pdo->prepare( 'UPDATE comment SET lft=lft-? where lft> ?' );
	$stmt->execute( array( $width,$myRight ) );


	Database::disconnect();
	header( "Location: index.php" );
}



