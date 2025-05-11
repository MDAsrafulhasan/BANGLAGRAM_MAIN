<?php
include 'connect.php';

if (!$conn) {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Database connection failed: ' . mysqli_connect_error()));
    exit();
}

$sql = "SELECT src, alt FROM slideshow_images";
$result = $conn->query($sql);

if (!$result) {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Error executing query: ' . $conn->error));
    exit();
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>