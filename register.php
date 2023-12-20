<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php
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
    <link rel="stylesheet" href="./stylelogin.css">
    <title>BookHaven</title>
</head>

<body>
    <div id="logreg-forms">
        <form method="POST">


            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign Up</h1>

            <input type="email" id="user-email" class="form-control" name="inputEmail" placeholder="Email address" required autofocus="">
            <br>
            <input type="password" id="user-pass" class="form-control" name="inputPassword" placeholder="Password" required minlength="8" autofocus="">
            <br>
            <input type="password" id="user-repeatpass" class="form-control" name="inputRepeatPassword" placeholder="Repeat Password" required minlength="8" autofocus="">

            <button class="btn btn-primary btn-block" type="submit" name="submit-signup"><i class="fas fa-user-plus"></i> Sign Up</button>
            <a href="login.php"> Back</a>
        </form>
        <br>

    </div>
    <p style="text-align:center">
        <a href="http://bit.ly/2RjWFMfunction toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})g" target="_blank" style="color:black"></a>
    </p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./script.js"></script>
    <?php
    if (isset($_POST['submit-signup'])) {
        if (empty($_POST['inputEmail']) || empty($_POST['inputPassword']) || empty($_POST['inputRepeatPassword'])) {
            echo '<script>alert("Please fill all inputs")</script>';
        } else {
            if ($_POST['inputPassword'] !== $_POST['inputRepeatPassword']) {
                echo '<script>alert("Passwords fields don\'t match")</script>';
            } else {
                include_once('./actions/connection.php');

                $email = $_POST['inputEmail'];
                $password = $_POST['inputPassword'];

                //checking if user exists
                $query = "SELECT * FROM user WHERE email = '$email'";
                $user_query = mysqli_query($con, $query);
                $exists = mysqli_num_rows($user_query);

                if ($exists > 0) {
                    echo '<script>alert("Email already exists")</script>';
                } else {
                    // Use password_hash for secure password hashing
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $insert_query = "INSERT INTO user(email, password, OTP) VALUES('$email','$hashed_password', '')";

                    if (mysqli_query($con, $insert_query)) {
                        echo '<script>alert("User registered successfully")</script>';
                    } else {
                        echo '<script>alert("Registration failed")</script>';
                    }
                }
            }
        }
    }
    ?>
</body>

</html>