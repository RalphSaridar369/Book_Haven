<link rel="icon" href="../images/logo2.png" type="image/x-icon">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php
session_start();
if (isset($_SESSION['id']) || isset($_SESSION['email'])) {
    header('Location: home.php');
    exit();
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
    <link rel="stylesheet" href="../stylelogin.css">
    <title>BookHaven</title>
</head>

<body>
    <div id="logreg-forms">
        <form class="form-signin" method="POST">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center">Sign in</h1>


            <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus="">
            <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>

            <button name="submit-login" class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>
            <a href="#" id="forgot_pswd">Forgot password?</a>
            <hr>

            <!-- <p>Don't have an account!</p>  -->
            <button class="btn btn-primary btn-block" type="button">
                <a href="register.php" style="color:white;text-decoration:none;text-align:center;">
                    <i class="fas fa-user-plus"></i> Sign up New Account
                </a>
            </button>
        </form>

        <div class="form-reset">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Reset Password</h1>
            <input type="email" id="resetEmail" class="form-control inputEmail" placeholder="Email address" required autofocus="">
            <button id="submit-reset" name="submit-reset" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Reset Password</button>
            <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../script.js"></script>



    <?php

    if (isset($_POST['submit-login'])) {
        if (empty($_POST['inputEmail']) || empty($_POST['inputPassword'])) {
            echo '<script>alert("Please fill all inputs")</script>';
        } else {
            include_once('../actions/connection.php');

            $email = trim($_POST['inputEmail']);
            $password = $_POST['inputPassword'];

            $email = mysqli_real_escape_string($con, $email);

            $check_login = "SELECT * FROM user WHERE LOWER(Email) = LOWER('$email')";
            $user_query = mysqli_query($con, $check_login);

            if ($user_query) {
                $user = mysqli_fetch_assoc($user_query);

                if ($user) {
                    if (password_verify($password, $user['Password'])) {
                        $_SESSION['id'] = $user['ID'];
                        $_SESSION['email'] = $user['Email'];
                        header('Location: home.php');
                        exit();
                    } else {
                        echo '<script>alert("Incorrect email or password")</script>';
                    }
                } else {
                    echo '<script>alert("User not found")</script>';
                }
            } else {
                echo '<script>alert("Query failed")</script>';
            }
        }
    }
    ?>




    <script>
        $(document).ready(function() {
            $('#submit-reset').on('click', function() {
                var inputEmail = $('.inputEmail').val();

                $.ajax({
                        type: 'POST',
                        url: '../actions/sendEmail.php',
                        data: {
                            'submit-reset': true,
                            'inputEmail': inputEmail
                        },
                        dataType: 'json',
                    })
                    .done(function(response) {
                        if (response.success) {
                            alert(response.message);
                            window.location.href = `./reset.php?key=${response.key}&email=${inputEmail}`;
                        } else {
                            alert('Error: ' + response.message);
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log(typeof jqXHR)
                        console.log(jqXHR)
                        console.log(textStatus + "\n")
                        console.log(errorThrown)
                        alert('AJAX request failed: ');
                    });
            });
        });
    </script>


</body>

</html>