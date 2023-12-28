<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="icon" href="../images/logo2.png" type="image/x-icon">
<?php
if (!isset($_GET['key']) || !isset($_GET['email'])) {
    header("Location: ./login.php");
    exit();
} else {
    $email = $_GET['email'];
    echo "<script>var userEmail = '$email';</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-GLhlTQ8iN17SKgyRUxZNl+Uu7anh2U6zfeqVrO8C6q8x0n2tOr/zmZKUfH5O5f5y" crossorigin="anonymous">
    <link rel="stylesheet" href="../reset.css">
    <title>BookHaven</title>

    <script>
        $(document).ready(function() {
            $("#submit-reset-password").click(function(e) {
                e.preventDefault();

                var otp = $("#inputOTP").val();
                var password = $("#inputRPassword").val();
                var confirmPassword = $("#inputRCPassword").val();

                var email = userEmail;

                if (otp.length < 1 || password.length < 1 || confirmPassword.length < 1) {
                    alert('Please fill all the fields');
                } else if (password !== confirmPassword) {
                    alert('Password fields don\'t match');
                } else {
                    $.ajax({
                        type: "POST",
                        url: "../actions/resetPassword.php",
                        data: {
                            email: email,
                            otp: otp,
                            password: password,
                            confirmPassword: confirmPassword
                        },
                        dataType: "json",
                        success: function(response) {
                            console.log(response);

                            if (response.success) {
                                alert("Password reset successful!");
                                window.location.href = "./login.php";
                            } else {
                                alert("Password reset failed: " + response.message);
                            }
                        },
                        error: function(error) {
                            console.log("Error:", error);
                        }
                    });
                }
            });
        });
    </script>

</head>

<body>

    <div id="logreg-forms">

        <div class="form-signin" method="POST">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Reset Password</h1>


            <input type="text" id="inputOTP" name="inputOTP" class="form-control" placeholder="OTP" required autofocus="" maxlength="6" pattern="[0-9]+">
            <input type="password" id="inputRPassword" name="inputRPassword" class="form-control" placeholder="Password" required>
            <input type="password" id="inputRCPassword" name="inputRCPassword" class="form-control" placeholder="Confirm Password" required>

            <button name="submit-login" id='submit-reset-password' class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Reset Password</button>
        </div>
    </div>


</body>

</html>