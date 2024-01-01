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
    <link rel="stylesheet" href="../addBook.css">
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

        <form id="add_book_form" method="POST" enctype="multipart/form-data">

            <div class="add_book_form_left">
                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="text" class="form-control" id="Title" name="title" placeholder="title" required>
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="Description" name="description" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="Author">Author</label>
                    <input type="text" class="form-control" id="Author" name="author" placeholder="author" required>
                </div>
                <div class="form-group">
                    <label for="DatePub">Publication Date</label>
                    <input type="date" class="form-control" id="DatePub" name="publication_date" placeholder="date" required>
                </div>
                <div class="form-group">
                    <label for="Genre">Genre</label>
                    <select class="form-control" id="Genre" name="genre" required>
                        <option>Science</option>
                        <option>Horror</option>
                        <option>Psychology</option>
                        <option>Novel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="BookLength">Book Length</label>
                    <input type="number" class="form-control" id="BookLength" name="book_length" placeholder="number of pages" required>
                </div>
                <div class="form-group">
                    <label for="Price">Price</label>
                    <input type="number" class="form-control" id="Price" name="price" placeholder="price" required>
                </div>
                <div class="form-group">
                    <label for="Awards">Award(s)</label>
                    <input type="text" class="form-control" id="Awards" name="awards" placeholder="Award(s)" required>
                </div>
            </div>

            <div class="add_book_form_right">
                <div class="form-group" style="display:flex; flex-direction:column">
                    <label for="imageForBook" style="margin-bottom:20px!important;">Image</label>
                    <img src="../images/default-placeholder.png" style="width:200px;margin-bottom:40px!important;" id="chosenImage" />
                    <input type="file" class="form-control-file" id="imageForBook" name="imageForBook" onchange="handleFileChange()" required>
                    <input type="submit" name="submit_book" class="clickable add_book_button" />
                </div>
            </div>

        </form>
    </div>

    <script>
        function handleFileChange() {
            var fileInput = document.getElementById('imageForBook');
            var imgElement = document.getElementById('chosenImage');

            if (fileInput.files.length > 0) {
                var selectedFile = fileInput.files[0];

                var maxSize = 500000; // 500 KB
                if (selectedFile.size > maxSize) {
                    alert('File size exceeds the limit of 500 KB. Please choose a smaller file.');
                    fileInput.value = '';
                    imgElement.src = '../images/default-placeholder.png';
                    return;
                }

                if (selectedFile.type.startsWith('image/')) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        imgElement.src = e.target.result;
                    };

                    reader.readAsDataURL(selectedFile);
                } else {
                    alert('Please select a valid image file.');
                    fileInput.value = '';
                    imgElement.src = '../images/default-placeholder.png';
                }
            } else {
                alert('Please select an image file.');
                imgElement.src = '../images/default-placeholder.png';
            }
        }



        function submitForm() {
            var form = document.getElementById('add_book_form');
            form.submit();
        }
    </script>

    <?php
    if (isset($_POST['submit_book'])) {
        include('../actions/admin/connection.php');
        $dir = "../images/booksForHome/";

        if (isset($_FILES["imageForBook"]) && !empty($_FILES["imageForBook"]["name"])) {
            $tfile = $dir . basename($_FILES["imageForBook"]["name"]);
            $fextension = strtolower(pathinfo($tfile, PATHINFO_EXTENSION));

            if (move_uploaded_file($_FILES["imageForBook"]["tmp_name"], $tfile)) {
                $filename = basename($_FILES["imageForBook"]["name"]);

                $title = mysqli_real_escape_string($con, $_POST['title']);
                $description = mysqli_real_escape_string($con, $_POST['description']);
                $author = mysqli_real_escape_string($con, $_POST['author']);
                $date = mysqli_real_escape_string($con, $_POST['publication_date']);
                $genre = mysqli_real_escape_string($con, $_POST['genre']);
                $price = (float)$_POST['price'];
                $pageCount = (int)$_POST['book_length'];
                $award = mysqli_real_escape_string($con, $_POST['awards']);

                $sql = "INSERT INTO book (Title, Description, Author, Date, Genre, Price, Page_Count, Award, Image_link)
    VALUES ('$title', '$description', '$author', '$date', '$genre', $price, $pageCount, '$award', '$filename')";

                mysqli_query($con, $sql);
                echo '<script>alert("Book created successfully");</script>';
            } else {
                echo "Error occurred while uploading your file.";
            }
        } else {
            echo "No file selected.";
        }
    }
    ?>


</body>

</html>