<?php 
	
	header("Access-Control-Allow-Origin: *");
	$server = "sql12.freemysqlhosting.net";
	$username = "sql12215611";
	$pass = "6DNPPd5Jd7";
	$db = "sql12215611";

	$connection = mysqli_connect($server, $username, $pass, $db);
	
	if ($_REQUEST) {
		$search_query = $_REQUEST['q'];
		$query_result = $connection->query("SELECT * FROM bluejack WHERE title LIKE '%$search_query%' ");
	}else{
		$query_result = $connection->query("SELECT * FROM bluejack");
	}

	$buku = [];
	$count = 0;
	$books = new stdClass();
	
	while ($data = $query_result->fetch_assoc()) {
		$buku[] = $data;
		$count=$count+1;
	}

	$books->count = $count;
	
	if ($_REQUEST) {
		$books->q = $search_query;
	}

	$books->buku= $buku;
	header('Content-Type: application/json');
	print json_encode($books);

?>