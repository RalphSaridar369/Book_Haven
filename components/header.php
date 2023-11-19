<!DOCTYPE html>
<html lang="en">

<body>
    <div class="header_container">
        <img src="./images/Logo.png" alt="logo" class="logo_image">
        <div>
            <a href="/login.php">Login</a>
            <span style="color:white">|</span>
            <a href="/register.php">Register</a>
        </div>
    </div>

    <div class="header_container_2">
        <img src="./images/Logo.png" alt="logo" class="logo_image">
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
            <a href="/login.php">Login</a><br /><br />
            <a href="/register.php">Register</a>
        </div>
    </div>
</body>

</html>