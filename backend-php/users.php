<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'connection.php';

$stmt = $conn->prepare("SELECT * FROM registration");
$stmt->execute();
$result = $stmt->get_result();

$users = array();

while ($row = $result->fetch_assoc()) {
    $profilePicBlob = $row['profilePic'];
    $profilePicBase64 = base64_encode($profilePicBlob);
    $user = array(
        "firstName" => $row['firstName'],
        "lastName" => $row['lastName'],
        "email" => $row['email'],
        "profilePic" => $profilePicBase64,
        "phoneNumber" => $row['phoneNumber']
    );

    $users[] = $user;
}

$response = array("status" => "success", "users" => $users);

header("Content-Type: application/json");

echo json_encode($response);

$stmt->close();

$conn->close();
?>
