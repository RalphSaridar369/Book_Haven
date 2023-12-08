<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./footer.css">
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./bookDetails.css">
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

        function changeTotal(element) {
            const price_element = document.getElementById('price_text')
            const price = parseFloat(price_element.innerText.split('$')[1])
            const total_element = document.getElementById('total_text')
            total_element.innerText = "Total: $" + element.value * price + ".00"
        }
    </script>
</head>

<body>
    <div>
        <div class="header_wrapper">
            <?php include("./components/header.php") ?>
        </div>
    </div>

    <!-- add to cart -->
    <!-- need to change values to become dynamic -->
    <?php
    if (isset($_POST['submit_quantity']) && strlen($_POST['quantity']) > 0) {
        if (empty($_POST['quantity'])) {
            echo '<script>alert("Please insert quantity");</script>';
        } else {

            include_once('./actions/connection.php');
            $result = mysqli_query($con, "SELECT * FROM book WHERE id = " . $_GET['id']);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
                $userEmail = 'user@hotmail.com';

                //checking if exists already
                $lineItemId = mysqli_real_escape_string($con, $_GET['id']);

                $sql = "SELECT * FROM user u JOIN line_item l ON u.ID = l.User_ID WHERE l.User_ID = 1 AND l.ID = '$lineItemId'";
                $lineItem = mysqli_query($con, $sql);

                if ($lineItem) {
                    $row = mysqli_fetch_assoc($cartQuery);

                    if ($row) {
                        //updating line item
                        $lineItemId = mysqli_real_escape_string($con, $_GET['id']);
                        $quantityToAdd = mysqli_real_escape_string($con, $_POST['quantity']);

                        $sql = "UPDATE line_item SET Quantity = Quantity + $quantityToAdd WHERE ID = '$lineItemId' AND User_ID = 1";

                        $result = mysqli_query($con, $sql);
                    } else {
                        echo 'No matching row found.';
                    }
                } else {
                    $cartQuery = mysqli_query($con, "SELECT * FROM cart c JOIN user u ON c.user_id = u.id WHERE c.ID = 1 AND u.Email = '$userEmail'");
                    $cart = mysqli_fetch_assoc($cartQuery);

                    if ($cart) {
                        $title = mysqli_real_escape_string($con, $row['Title']);
                        $price = mysqli_real_escape_string($con, $row['Price']);
                        $link = mysqli_real_escape_string($con, $row['Image_link']);
                        $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
                        $cartId = mysqli_real_escape_string($con, $cart['ID']);

                        $result = mysqli_query($con, "INSERT INTO line_item (Title, Price, Quantity, Image_link, Cart_ID) 
                        VALUES ('$title', '$price', '" . intval($quantity) . "', '$link', '$cartId')");


                        if (!$result) {
                            echo '<script>alert("Error while inserting book");</script>';
                        } else {
                            echo '<script>alert("Product added to cart");</script>';
                        }
                    } else {
                        echo '<script>alert("Error: Cart not found for the specified user");</script>';
                    }
                }
            }
        }
    } else {
        echo '<script>alert("Please insert quantity");</script>';
    }
    ?>

    <!-- getting book details -->
    <?php
    include_once('./actions/connection.php');

    $result = mysqli_query($con, "SELECT * FROM book WHERE id = " . $_GET['id']);
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo '          
          <div class="book_container">
            <div class="book_image_container">
                <img class="book_image" src="./images/booksForHome/' . $row['Image_link'] . '" />
            </div>
            <div class="book_details_container">
                <h1>' . $row['Title'] . '</h1>
                <div>
                    <h4>Genre: ' . $row['Genre'] . '</h4>
                    <h4>Publication Date: ' . $row['Date'] . '</h4>
                    <h4>Author: ' . $row['Author'] . '</h4>
                    <h4>Page Count: ' . $row['Page_Count'] . ' Pages</h4>
                    <h4>Awards or Recognitions: ' . $row['Award'] . '</h4>
                </div>
            </div>
            <form class="add_to_cart_container" method="POST">
                <h2 id="price_text">Price: $' . number_format(floatval($row['Price']), 2) . ' </h2>
                <h2 id="total_text"> Total: $0</h2>
                <input type="number" placeholder="quantity" name="quantity" class="quantity_input" onchange="changeTotal(this)" oninput="changeTotal(this)" />
                <input type="submit" name="submit_quantity" class="quantity_submit" />
            </form>
            </div>
            <div class="description_container">
                <h1>Description</h1>
                <p>' . $row['Description'] . '</p>
            </div>
                ';
        }
    }
    ?>

</body>

</html>