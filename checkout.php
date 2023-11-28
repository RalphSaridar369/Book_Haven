<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./checkout.css">

    <title>BookHaven</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Esteban&display=swap" rel="stylesheet">

    <script>
        function handleMenu() {
            let menu = document.getElementById('menu_shown_not_shown').classList.contains("menu_not_shown")
            if (menu) {
                menu = document.getElementById('menu_shown_not_shown')
                menu.classList.add("menu_shown")
                menu.classList.remove("menu_not_shown")
                document.getElementsByClassName('burger_icon')[0].style.display = 'none';
                document.getElementsByClassName('header_container_2')[0].style.display = 'flex-start';
            } else {
                menu = document.getElementById('menu_shown_not_shown')
                menu.classList.add("menu_not_shown")
                menu.classList.remove("menu_shown")
                document.getElementsByClassName('burger_icon')[0].style.display = 'block';
                document.getElementsByClassName('header_container_2')[0].style.display = 'center';

            }
        }
    </script>
</head>

<body>
    <div>
        <div class="header_wrapper">
            <?php include("./components/header.php") ?>
        </div>
    </div>

    <div class="checkout_container">
        <form class="left_checkout_container" method="POST">
            <input type="text" placeholder="First Name" name="first_name" />
            <input type="text" placeholder="Last Name" name="last_name" />
            <input type="text" placeholder="City" name="city" />
            <input type="text" placeholder="Address" name="address" />
            <input type="text" placeholder="Street" name="street" />
            <input type="text" placeholder="Phone Number" name="phone_number" />
            <input type="submit" class="checkout_submit" />
        </form>
        <div class="right_checkout_container">
            <div class="right_checkout_item">
                <img src="./images/booksForHome/1.jpg" alt="image_book" />
                <h3>Title</h3>
            </div>
        </div>
    </div>

</body>

</html>