<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $email = $data["email"];
    $password = $data["password"];

    $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) { 

            $profilePicBlob = $row['profilePic'];
            $profilePicBase64 = base64_encode($profilePicBlob);
             $user = array(
            "firstName" => $row['firstName'],
            "lastName" => $row['lastName'],
            "email" => $row['email'],
            "profilePic"=> $profilePicBase64,
            "phoneNumber" => $row['phoneNumber']
        );
            $response = array("status" => "success", "message" => "User logged in successfully","user"=> $user);
            header("Content-Type: application/json");
            echo json_encode($response);
        } else {
            $response = array("status" => "error", "message" => "Invalid password");
            header("Content-Type: application/json");
            echo json_encode($response);
        }
    } else {
        $response = array("status" => "error", "message" => "User not found");
        header("Content-Type: application/json");
        echo json_encode($response);
    }

    $stmt->close();

    $conn->close();

  
}
?>



