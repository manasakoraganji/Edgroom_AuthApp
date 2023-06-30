<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $password = $_POST["password"];

    $checkStmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $response = array("status" => "error", "message" => "Email already exists. Please choose a different email.");
        echo json_encode($response);
    } else {
        $profilePic = $_FILES["profilePic"]["tmp_name"];
        $profilePicData = file_get_contents($profilePic);
        $insertStmt = $conn->prepare("INSERT INTO registration (firstName, lastName, email, phoneNumber, profilePic, password) VALUES (?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("ssssss", $firstName, $lastName, $email, $phoneNumber, $profilePicData, $password);

        if ($insertStmt->execute()) {
            $response = array("status" => "success", "message" => "User registered successfully");
            header("Content-Type: application/json");
            echo json_encode($response);
        } else {
            $response = array("status" => "error", "message" => "Error registering user: " . $insertStmt->error);
            header("Content-Type: application/json");
            echo json_encode($response);
        }

        $insertStmt->close();
    }

    $checkStmt->close();

    $conn->close();
}
?>
