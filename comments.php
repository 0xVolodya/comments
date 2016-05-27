<?php


include 'database.php';
$pdo = Database::connect();
$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//
////$sql = "SELECT 'rgt' FROM comment WHERE 'comment_name'='root'";
//$sql = "SELECT * FROM comment";
//
//$q   = $pdo->query( $sql );
////		$q->execute( array( $name, $text,$parent_id ) );
//$q->fetchAll(PDO::FETCH_ASSOC);

//
//$rows = $pdo->query( 'SELECT node.comment_name
//  FROM comment as node,
//  comment as parent
//	WHERE node.lft BETWEEN parent.lft and parent.rgt
//	and parent.comment_name="root"
//	ORDER BY node.lft
//  ' );

$rows = $pdo->query( 'SELECT node.id,(COUNT(parent.comment_name)-1) as depth
FROM comment as node,comment as parent
WHERE node.lft BETWEEN parent.lft and parent.rgt
GROUP BY node.comment_name
ORDER BY node.lft' );

$html;
foreach ( $rows as $row ) {
	$html[ $row['id'] ] = $row['depth'];
//	echo $row['id']; //etc...
}
//var_dump( $html );

$result;
$prev   = 1;
$result = '<ul class="media">';

while ( list( $key, $value ) = each( $html ) ) {
	$value = intval( $value );
	$stmt  = $pdo->prepare( 'SELECT node.comment_name,node.text,node.parent_id
		FROM comment as node WHERE node.id=?' );
	$stmt->execute( array( $key ) );
	$stmt = $stmt->fetch();
//	var_dump( $key, $value );

	if ( $stmt["parent_id"] == 0 ) {
		continue;
	}
	if ( $value > $prev ) {
		$result .= '<ul class="media-body">';

		$result .= '<li class="li_comment li_comment_' . $key . '">';
		$result .= '<div class="well"><h4 class="li_comment-heading">' . $stmt["comment_name"] . ' says: </h4>';
		$result .= '<p class=" li_comment-text">' . $stmt["text"] . '</p>' .
		           '<a class="btn btn-danger" href="delete.php?id=' .
		           $key . '">Delete</a>' .
		           "<a href=\"create.php\" class=\"btn btn-success reply_button\" id=\"{$key}\">reply</a>".
		           '<a class="btn btn-primary edit_button" href="" id="'.$key.'">Edit</a>' .
		           "</div></li>";


	} else if ( $value == $prev ) {
		$result .= '<li class="li_comment li_comment_' . $key . '">' ;
		$result .= '<div class="well"><h4 class="li_comment-heading">' . $stmt["comment_name"] . ' says: </h4>';
		$result .= '<p class=" li_comment-text">' . $stmt["text"] . '</p>' .
		           '<a class="btn btn-danger" href="delete.php?id=' .
		           $key . '">Delete</a>' .
		           "<a href=\"create.php\" class=\"btn btn-success  reply_button\" id=\"{$key}\">reply</a>".
		           '<a class="btn btn-primary edit_button" href="" id="'.$key.'">Edit</a>' .
		           "</div></li>";

	} else {
		$i = $value;
		$j = $prev;
		while ( $i < $j ) {
			$result .= "</ul>";
			$result .= "</li>";
			$i ++;
		}
		$result .= '<li class="li_comment li_comment_' . $key . '">';
		$result .= '<div class="well"><h4 class="li_comment-heading">' . $stmt["comment_name"] . ' says: </h4>';
		$result .= '<p class=" li_comment-text">' . $stmt["text"] . '</p>' .
		           '<a class="btn btn-danger" href="delete.php?id=' .
		           $key . '">Delete</a>' .
		           "<a href=\"create.php\" class=\"btn btn-success reply_button\" id=\"{$key}\">reply</a>".
		           '<a class="btn btn-primary edit_button" href="" id="'.$key.'">Edit</a>' .
		           "</div></li>";


	}
	$prev = $value;
}
echo $result;

//$stmt = $pdo->query('SELECT rgt from comment WHERE comment_name="root"');
//$myRight=$stmt->execute();

//$stmt = $pdo->prepare('UPDATE comment SET rgt=rgt+2 where rgt> ?');
//$stmt->execute(array($myRight));
//
//$stmt = $pdo->prepare('UPDATE comment SET lft=lft+2 where lft> ?');
//$stmt->execute(array($myRight));

//$stmt = $pdo->prepare('INSERT INTO comment(`comment_name`,`lft`,`rgt`)VALUES(?, ?,?)');
//$stmt->execute(array('vova',$myRight+1,$myRight+2 ));









