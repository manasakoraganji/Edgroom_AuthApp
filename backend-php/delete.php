<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data["email"];

    $stmt = $conn->prepare("DELETE FROM registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response = array("status" => "success", "message" => "User deleted successfully");
        header("Content-Type: application/json");
        echo json_encode($response);
    } else {
        $response = array("status" => "error", "message" => "Failed to delete user");
        header("Content-Type: application/json");
        echo json_encode($response);
    }

    $stmt->close();

    $conn->close();
}
?>
