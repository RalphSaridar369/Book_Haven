<?php
function generateRandomNumber()
{
    return rand(100000, 999999);
}

include_once('./connection.php');

$email = $_POST['inputEmail'];

$check_user = "SELECT * FROM user WHERE LOWER(Email) = LOWER('$email')";
$user_query = mysqli_query($con, $check_user);

if ($user_query) {


    $user = mysqli_fetch_assoc($user_query);

    if (mysqli_num_rows($user_query) > 0) {
        $user_otp = generateRandomNumber();
        $user_otp_hashed = password_hash($user_otp, PASSWORD_DEFAULT);

        $otp_query = "UPDATE user SET OTP = '$user_otp_hashed' WHERE Email = '$email'";
        $user_otp_query = mysqli_query($con, $otp_query);

        if ($user_otp_query) {

            $api_key = '4CE223B8071256FC50AB0ECBD7EFA0E0C58112175C48ED0094606278BA98A066BBB9D9FA56490C69E7A0148FE0D54801';
            $url = 'https://api.elasticemail.com/v2/email/send';

            $to = $user['Email'];
            $subject = "Password Reset";

            $message = '
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <title>Password Reset</title>
                    </head>
                    <body>
                        <p>Hello ' . $email . ',</p>
                    
                        <p>We received a request to reset your password. If you did not initiate this request, please disregard this email.</p>
                    
                        <p>To reset your password, click on the following link:</p>
                        <p><a href="./reset.php?key=' . $user_otp_hashed . '&email=' . $email . '" target="_blank">Reset Password</a></p>
                    
                        <p>Alternatively, you can use the following One-Time Password (OTP):</p>
                        <p><strong>' . $user_otp . '</strong></p>
                    
                        <p>Thank you,</p>
                        <p>BookHaven</p>
                    </body>
                    </html>
                ';

            $data = [
                'apikey' => $api_key,
                'subject' => $subject,
                'from' => 'r.saridar@optidist.com',
                'fromName' => 'BookHaven',
                'to' => $to,
                'bodyHtml' => $message,
            ];

            $options = [
                'http' => [
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data),
                ],
            ];

            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);

            if ($result) {
                $response = ['success' => true, 'message' => 'Please check your email', 'result' => $result,  'key' => $user_otp_hashed];
            }



            if ($result !== FALSE) {
                $response = ['success' => true, 'message' => 'Please check your email', 'result' => $result, 'key' => $user_otp_hashed];
                echo json_encode($response);
            } else {
                $response = ['success' => false, 'message' => 'Error while sending an email'];
                echo json_encode($response);
            }
        } else {
            $response = ['success' => false, 'message' => 'Failed to update OTP'];
            echo json_encode($response);
        }
    } else {
        $response = ['success' => false, 'message' => 'User not found'];
        echo json_encode($response);
    }
} else {
    $response = ['success' => false, 'message' => 'Query failed'];
    echo json_encode($response);
}
