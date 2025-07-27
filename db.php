<?php
ob_start();
session_start();
$conn = new mysqli('localhost', 'root', '', 'hotel-vishal');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$web = "http://localhost/Hotel-Vishal/";
$admin = "{$web}admin/";

$bootstrap = "{$web}";
$images = "{$web}assets/images/";
$logo = "{$web}assets/images/logo.png";
$bootstrap_css = "{$web}plugins/bootstrap-4.0.0/dist/css/";
$bootstrap_js = "{$web}plugins/bootstrap-4.0.0/dist/js/";

?>
