<?php
include_once('./connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST["otp"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    $check_query = mysqli_query($con, "SELECT * FROM user WHERE Email = '$email'");

    if ($check_query) {
        $user = mysqli_fetch_assoc($check_query);

        if (password_verify($otp, $user['OTP'])) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($con, "UPDATE user SET Password = '$hashed_password' WHERE Email = '$email'");

            $response = ['success' => true, 'message' => 'Password reset successful'];
            echo json_encode($response);
            exit();
        } else {
            $response = ['success' => false, 'message' => 'Incorrect OTP'];
            echo json_encode($response);
            exit();
        }
    } else {
        $error_message = mysqli_error($con);
        http_response_code(500);
        echo "Query failed: " . $error_message;
        exit();
    }
} else {
    header("Location: ./login.php");
    exit();
}
