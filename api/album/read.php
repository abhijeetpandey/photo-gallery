<?php

// To handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  http_response_code(200);
  die();
}

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/album.php';
 
// instantiate database
$database = new Database();
$db = $database->getConnection();

$album = new Album($db);

if (isset($_GET['username'])) {
	$album->created_by = $_GET['username'];
	$stmt = $album->readByUsername();
}
else {
	$stmt = $album->readAll();
}
$num = $stmt->rowCount();

if ($num > 0) {
	$album_array = array();
	$album_array['albums'] = array();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$single_array = array(
			"id" => $id,
			"name" => $name,
			"description" => html_entity_decode($description),
			"created_by" => $created_by,
			"cover_photo" => $cover_photo,
			"created_at" => $created_at,
			"photo_count" => $photo_count,
			"likes_count" => $likes_count
		);

		array_push($album_array['albums'], $single_array);
	}

	http_response_code(200);
	echo json_encode($album_array);
}
else {
	http_response_code(404);
	echo json_encode(array("message" => "No albums found"));
}