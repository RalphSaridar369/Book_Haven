<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_email'])) {
    header('Location: login.php');
    exit();
}
?>

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

        <div style="display:flex; justify-content:flex-end;">
            <div class="clickable" onclick="goToAddBook(event)" style="
                text-align:center;
                margin-bottom:20px!important;
                width:150px!important;
                border:1px rgba(162.264, 246.263, 121.88, 1) solid;
                color:white;
                padding:5px 0!important;
                background-color:rgba(162.264, 246.263, 121.88, 1);
                border-radius: 10px;">
                Add Book
            </div>
        </div>
        <table class="table full-height">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Date</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once('../actions/admin/connection.php');
                $sql = "SELECT * FROM book";
                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr id='book-" . $row['ID'] . "' class='clickable' onclick='redirect(event," . $row['ID'] . ")'>
                                <td>" . $row["ID"] . "</td>
                                <td><img src='../images/booksForHome/" . $row["Image_link"] . "'/></td>
                                <td>" . $row["Title"] . "</td>
                                <td>" . $row["Author"] . "</td>
                                <td>" . $row["Date"] . "</td>
                                <td>$" . $row["Price"] . "</td>
                                <td>
                                    <img src='../images/icons/delete.png' class='delete-icon' onClick=\"deleteBook(" . $row["ID"] . ")\" alt='image_book' />
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No books found</td></tr>";
                }

                ?>
            </tbody>
        </table>
    </div>


    <script>
        function goToAddBook(event) {
            event.preventDefault();
            window.location.href = "./addBook.php";
        }

        function redirect(event, id) {
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