<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<body>
    <div class="header_container">
        <a href="./home.php">
            <img src="./images/Logo.png" alt="logo" class="logo_image">
        </a>
        <div>
            <?php
            if (isset($_SESSION['id']) || isset($_SESSION['email'])) {
                echo '
                <div style="display:flex;gap:40px;">
                    <a href="./home.php">Home</a>
                    <a href="./checkout.php">My Cart</a>
                    <p class="logout_button" style="color:white">Logout</p>
                </div>';
            } else {
                echo '
                <a href="./login.php">Login</a>
                <span style="color:white">|</span>
                <a href="./register.php">Register</a>';
            }
            ?>
        </div>
    </div>

    <div class="header_container_2">
        <a href="./home.php">
            <img src="./images/Logo.png" alt="logo" class="logo_image">
        </a>
        <div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48" fill="white" class="burger_icon" onclick="handleMenu()">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z" />
            </svg>
        </div>
        <div id="menu_shown_not_shown" class="menu_not_shown">

            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48" fill="rgba(162.264, 246.263, 121.88, 1)" class="burger_icon" onclick="handleMenu()">
                <path d="M0 0h24v24H0V0z" fill="none" />
                <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z" />
            </svg>
            <br /><br /><br />
            <?php
            if (isset($_SESSION['id']) || isset($_SESSION['email'])) {
                echo '
                <a href="./home.php">Home</a><br /><br />
                <a href="./checkout.php">My Cart</a><br /><br />
                <p class="logout_button">Logout</p>';
            } else {
                echo '
                <a href="./login.php">Login</a><br /><br />
                <span style="color:white">|</span><br /><br />
                <a href="./register.php">Register</a>';
            }
            ?>
        </div>
    </div>

</body>
<script>
    $(document).ready(function() {
        // Handle logout click
        $('.logout_button').on('click', function(e) {
            console.log("first")
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: './actions/logout.php',
                data: {
                    logout: true
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        window.location.href = 'login.php';
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(xhr, status, error) {}
            });
        });
    });
</script>

</html>