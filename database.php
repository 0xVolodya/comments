<?php

/**
 * Created by PhpStorm.
 * User: vova
 * Date: 26.05.16
 * Time: 7:51
 */
class Database {

	private static $dbHost = 'localhost';
	private static $dbUser = 'root';
	private static $dbPass = '';
	private static $dbName = 'comments';
	private static $connection = null;


	public function __construct() {

		die();
	}

	public static function connect() {
		if ( self::$connection == null ) {
			try {
				self::$connection = new PDO( "mysql:host=" . self::$dbHost . ";" .
				                             "dbname=" . self::$dbName, self::$dbUser, self::$dbPass );

			} catch ( PDOException $e ) {
				die( $e->getMessage() );
			}
		}

		return self::$connection;
	}

	public static function disconnect() {
		self::$connection = null;
	}
}
/*while ( ($option = each( $children[ $parent ] ) ) || $parent > $root ) {

	$count += 1;
	if ( $option === false ) {
		$parent = array_pop( $parent_stack );
		$html[] = str_repeat( "\t", 5 ) . "</ul>";
		$html[] = str_repeat( "\t", 5 ) . "</li>";
	} elseif ( ! empty( $children[ $option['value']['id'] ] ) ) {
		$tab = str_repeat( "\t", 5 );


		$html[] = "<li class='li_comment_{$row['id']}'>" .
		          '<div>' . $row['name'] . '</div>' .
		          '<div>' . $row['text'] . '</div>' .
		          '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Delete</a>' .
		          "<a href=\"create.php\" class=\"reply_button\" id=\"{$row['id']}\">reply</a>";
//			$html[] = $tab . "\t" . '<ul class="comment">';
		$html[] = $tab . "\t" . '<ul class="comment">';

		array_push( $parent_stack, $option['value']['id'] );

		$parent = $option['value']['id'];

	} else {


		$html[] = "<li class='li_comment_{$row['id']}'>" .
		          '<div>' . $row['name'] . '</div>' .
		          '<div>' . $row['text'] . '</div>' .
		          '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Delete</a>' .
		          "<a href=\"create.php\" class=\"reply_button\" id=\"{$row['id']}\">reply</a></li>>";

	}


}*/
