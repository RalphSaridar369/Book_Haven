<?php
session_start();
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="../header.css">
    <link rel="icon" href="../images/logo2.png" type="image/x-icon">
    <title>Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body style="width:100vw; display:flex">

    <?php include("../components/menuAdmin.php") ?>


    <div class="component_content">

        <?php
        include_once('../actions/admin/connection.php');
        $id = $_GET['id'];

        $sql = "SELECT `order`.*, line_item.Image_link, line_item.Title, line_item.Quantity, line_item.Price
        FROM `order`
        JOIN line_item ON `order`.ID = line_item.Order_ID
        WHERE `order`.ID = '$id'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {

            $total = 0;
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $total += $row["Quantity"] * $row["Price"];
                $rows[] = $row;
            }

            $first_result = $result->fetch_assoc();
            echo '<h1>Order #: ' . $rows[0]['ID'] . '</h1><br/>';
            echo '<h2>Full Name: ' . $rows[0]['First_Name'] . ' ' . $rows[0]['Last_Name'] . '</h2><br/>';
            echo '<h4>City: ' . $rows[0]['City'] . '</h4>';
            echo '<h4>Address: ' . $rows[0]['Address'] . '</h4>';
            echo '<h4>Street: ' . $rows[0]['Street'] . '</h4>';
            echo '<h4>Phone Number: ' . $rows[0]['Phone_Num'] . '</h4><br/><br/>';


            echo '<h4>Total Price: $' . $total . '</h4><br/>';

            echo '<table class="table half-full-height">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($rows as $row) {
                echo "<tr>
                <th scope='row'>" . $row["ID"] . "</th>
                <td><img src='../images/booksForHome/" . $row["Image_link"] . "'/></td> 
                <td>" . $row["Title"] . "</td>
                <td>" . $row["Quantity"] . "</td>
                <td>$" . $row["Price"] . "</td>
            </tr>";
            }

            echo '</tbody>
            </table>';
        } else {
            echo "<tr><td colspan='5'>No books found</td></tr>";
        }

        mysqli_close($con);
        ?>

        </tbody>
        </table>
    </div>

    <script>
        function redirectPath(event, id) {
            event.preventDefault();
            window.location.href = "./bookDetails.php?id=" + id;
        }

        function deleteBook(id) {
            if (confirm("Are you sure you want to delete this book?")) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', `../actions/admin/deleteBook.php`, true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    var elementToDelete = document.getElementById('book-' + id);
                    console.log(elementToDelete)
                    console.log(elementToDelete.parentNode)
                    if (elementToDelete) {
                        elementToDelete.parentNode.removeChild(elementToDelete);
                    }
                    console.log(xhr)
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {

                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                alert("Done");
                            } else {
                                alert('Failed to delete item. Please try again.');
                            }
                        }
                    }
                };
                xhr.send('id=' + id);
            }
        }
    </script>
</body>

</html>