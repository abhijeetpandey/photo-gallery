<?php

// To handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  http_response_code(200);
  die();
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: multipart/form-data; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/album.php';
 
$database = new Database();
$db = $database->getConnection();

$album = new Album($db);

$data = json_encode($_POST);
$data = json_decode($data);

$album->id = $data->id;

$res = true;
foreach ($data as $key => $value) {
	if ($value) {
		$res = $res & $album->update($key, $value); 
	}
}

if (isset($_FILES['cover_photo'])) {
	$target = 'C:/xampp/htdocs/api/data/albumCoverPhotos/' . $album->id . '.jpeg';
	if (move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target)) {
		$res = $res & $album->update("cover_photo", $target);
	}
}

if ($res) {
	http_response_code(200);
	echo json_encode(array("message" => "Update successful"));
}
else {
	http_response_code(503);
	echo json_encode(array("message" => "Update unsuccessful"));
}