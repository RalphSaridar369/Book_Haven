<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./footer.css">
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./filterBar.css">

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

        function showDetails(element) {
            element.style.opacity = '0.08';
            console.log("show Details: ", element.nextElementSibling)
            element.nextElementSibling.style.opacity = '1';
            element.nextElementSibling.style.zIndex = '12'; // You can adjust the z-index value as needed
        }



        function hideDetails(element) {
            element.style.opacity = '1';
            console.log("hide Details: ", element.nextElementSibling)
            element.nextElementSibling.style.opacity = '0';
        }
    </script>
</head>

<body>
    <div>
        <div class="header_wrapper">
            <?php include("./components/header.php") ?>
        </div>
    </div>

    <div class="filter_wrapper">
        <?php include("./components/filterBar.php") ?>
    </div>

    <div class="products_container">
        <?php

        include_once('./actions/connection.php');

        $result = mysqli_query($con, "Select * From book");

        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                echo '
                <div class="product_container">
                    <img src="./images/booksForHome/' . $row['Image_link'] . '" class="product_image"  />
                    <a class="product_container_details" href="./bookDetails.php?id=' . $row['ID'] . '">
                        <h2 class="product_title">' . $row['Title'] . '</h2>
                        <h4>
                            Genre: ' . $row['Genre'] . ' <br />
                            Date: 1971<br />
                            Author: ' . $row['Author'] . '<br /><br /><br />
                        </h4>
                        <p class="product_price">
                            $' . $row['Price'] . '
                        </p>
                    </a>
                </div>';
            }
        }
        ?>
    </div>

    <img src="./images/wave-2.png" class="hero_wave_2" on />
</body>

</html>