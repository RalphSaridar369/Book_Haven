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


    <!-- update line items for customer's cart -->
    <?php

    // if ($_POST['submit_quantity']) {
    //     if (!isset($_POST['quantity']) || empty($_POST['quantity'])) {
    //         echo '<script>alert("Please insert quantity");</script>';
    //     } else {
    //         $result = mysqli_query($con, "INSERT INTO employee(EmpName, EmpSD, EmpTD, Salary) 
    //         Values ('$_POST[Ename]','$_POST[SDate]','$_POST[TDate]' ,'$_POST[Salary]')");

    //         if (!$result) {
    //             echo '<script>alert("Error while inserting book");</script>';
    //         }
    //     }
    // }

    ?>



    <!-- delete line items for customer's cart -->
    <?php

    // if ($_POST['submit_quantity']) {
    //     if (!isset($_POST['quantity']) || empty($_POST['quantity'])) {
    //         echo '<script>alert("Please insert quantity");</script>';
    //     } else {
    //         $result = mysqli_query($con, "INSERT INTO employee(EmpName, EmpSD, EmpTD, Salary) 
    //         Values ('$_POST[Ename]','$_POST[SDate]','$_POST[TDate]' ,'$_POST[Salary]')");

    //         if (!$result) {
    //             echo '<script>alert("Error while inserting book");</script>';
    //         }
    //     }
    // }

    ?>



    <!-- checkout cart and create order -->
    <?php
    // if ($_POST['submit_quantity']) {
    //     if (!isset($_POST['quantity']) || empty($_POST['quantity'])) {
    //         echo '<script>alert("Please insert quantity");</script>';
    //     } else {
    //         $result = mysqli_query($con, "INSERT INTO employee(EmpName, EmpSD, EmpTD, Salary) 
    //         Values ('$_POST[Ename]','$_POST[SDate]','$_POST[TDate]' ,'$_POST[Salary]')");

    //         if (!$result) {
    //             echo '<script>alert("Error while inserting book");</script>';
    //         }
    //     }
    // }
    ?>



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
            <!-- getting line items for customer's cart -->
            <?php
            include_once('./actions/connection.php');

            $result = mysqli_query($con, "Select * From line_item l, cart c Where l.Order_ID IS NULL AND c.User_ID = 1 ");
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    echo `
                    <div class="right_checkout_item">
                        <img src="./images/booksForHome/1.jpg" alt="image_book" />
                        <h3>Title</h3>
                    </div>`;
                }
            }
            ?>
        </div>
    </div>

</body>

</html>