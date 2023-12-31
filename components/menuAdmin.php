<!DOCTYPE html>
<html lang="en">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>
    <div class="header_container_3">
        <img src="../images/Logo.png" alt="logo" class="logo_image">
        <div>
            <a onclick="menuRedirect(event,'orders.php')" class="clickable">Orders</a>
        </div>
        <div>
            <a onclick="menuRedirect(event,'books.php')" class="clickable">Books</a>
        </div>
        <div>
            <a class="logout_button">Logout</a>
        </div>
    </div>
</body>
<script>
    function menuRedirect(event, path) {
        var currentUrl = "http://localhost/BookHaven/admin/" + path;
        var urlWithoutParams = currentUrl.split('?')[0];
        window.location.href = currentUrl
    }


    $(document).ready(function() {
        $('.logout_button').on('click', function(e) {
            console.log("first")
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '../actions/logout.php',
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