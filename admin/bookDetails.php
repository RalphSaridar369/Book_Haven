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
                    <input type="text" class="form-control" id="Title" name="title" placeholder="title" minlength="1">
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <textarea class="form-control" id="Description" name="description" rows="3" minlength="1"></textarea>
                </div>
                <div class="form-group">
                    <label for="Author">Author</label>
                    <input type="text" class="form-control" id="Author" name="author" placeholder="author" minlength="1">
                </div>
                <div class="form-group">
                    <label for="DatePub">Publication Date</label>
                    <input type="date" class="form-control" id="DatePub" name="publication_date" placeholder="date" minlength="1">
                </div>
                <div class="form-group">
                    <label for="Genre">Genre</label>
                    <select class="form-control" id="Genre" name="genre" minlength="1">
                        <option>Science</option>
                        <option>Horror</option>
                        <option>Psychology</option>
                        <option>Novel</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="BookLength">Book Length</label>
                    <input type="number" class="form-control" id="BookLength" name="book_length" placeholder="number of pages" minlength="1">
                </div>
                <div class="form-group">
                    <label for="Price">Price</label>
                    <input type="number" class="form-control" id="Price" name="price" placeholder="price" minlength="1">
                </div>
                <div class="form-group">
                    <label for="Awards">Award(s)</label>
                    <input type="text" class="form-control" id="Awards" name="awards" placeholder="Award(s)" minlength="1">
                </div>
            </div>

            <div class="add_book_form_right">
                <div class="form-group" style="display:flex; flex-direction:column">
                    <label for="imageForBook" style="margin-bottom:20px!important;">Image</label>
                    <img src="../images/default-placeholder.png" style="width:200px;margin-bottom:40px!important;" id="chosenImage" />
                    <input type="file" class="form-control-file" id="imageForBook" name="imageForBook" onchange="handleFileChange()" minlength="1">
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
    include('../actions/admin/connection.php');

    $id = $_GET['id'];
    $sql = "SELECT * FROM book WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if (
        mysqli_num_rows($result) > 0
    ) {
        $row = mysqli_fetch_assoc($result);

        $title = $row['Title'];
        $description = $row['Description'];
        $author = $row['Author'];
        $publication_date = $row['Date'];
        $genre = $row['Genre'];
        $book_length = $row['Page_Count'];
        $price = $row['Price'];
        $awards = $row['Award'];
        $image_path = $row['Image_link'];

        echo '
        <script>
            document.getElementById("Title").value = "' . $title . '";
            document.getElementById("Description").value = "' . $description . '";
            document.getElementById("Author").value = "' . $author . '";
            document.getElementById("DatePub").value = "' . $publication_date . '";
            document.getElementById("Genre").value = "' . $genre . '";
            document.getElementById("BookLength").value = "' . $book_length . '";
            document.getElementById("Price").value = "' . $price . '";
            document.getElementById("Awards").value = "' . $awards . '";
            document.getElementById("chosenImage").src = "../images/booksForHome/' . $image_path . '";
        </script>
    ';
    } else {
        echo "0 results";
    }


    if (isset($_POST['submit_book'])) {
        $dir = "../images/booksForHome/";

        if (isset($_FILES["imageForBook"]) && !empty($_FILES["imageForBook"]["name"])) {
            $tfile = $dir . basename($_FILES["imageForBook"]["name"]);
            $fextension = strtolower(pathinfo($tfile, PATHINFO_EXTENSION));

            if (move_uploaded_file($_FILES["imageForBook"]["tmp_name"], $tfile)) {
                $filename = basename($_FILES["imageForBook"]["name"]);
            } else {
                echo "Error occurred while uploading your file.";
                exit;
            }
        } else {
            $filename = '';
        }

        $title = mysqli_real_escape_string($con, $_POST['title']);
        $description = mysqli_real_escape_string($con, $_POST['description']);
        $author = mysqli_real_escape_string($con, $_POST['author']);
        $date = mysqli_real_escape_string($con, $_POST['publication_date']);
        $genre = mysqli_real_escape_string($con, $_POST['genre']);
        $price = (float)$_POST['price'];
        $pageCount = (int)$_POST['book_length'];
        $award = mysqli_real_escape_string($con, $_POST['awards']);

        $sql = "UPDATE book SET 
                Title = '$title',
                Description = '$description',
                Author = '$author',
                Date = '$date',
                Genre = '$genre',
                Price = $price,
                Page_Count = $pageCount,
                Award = '$award'";

        if (!empty($filename)) {
            $sql .= ", Image_link = '$filename'";
        }

        $sql .= " WHERE id = $id";

        if (mysqli_query($con, $sql)) {
            echo '<script>
            document.getElementById("Title").value = "' . htmlspecialchars($title) . '";
            document.getElementById("Description").value = "' . htmlspecialchars($description) . '";
            document.getElementById("Author").value = "' . htmlspecialchars($author) . '";
            document.getElementById("DatePub").value = "' . htmlspecialchars($date) . '";
            document.getElementById("Genre").value = "' . htmlspecialchars($genre) . '";
            document.getElementById("BookLength").value = "' . htmlspecialchars($pageCount) . '";
            document.getElementById("Price").value = "' . htmlspecialchars($price) . '";
            document.getElementById("Awards").value = "' . htmlspecialchars($award) . '";
          </script>';
            if (!empty($filename)) {
                echo '<script>
            document.getElementById("chosenImage").src = "../images/booksForHome/' . $filename . '";
            </script>;';
            }
            echo '<script>alert("Book updated successfully");</script>';
        } else {
            echo "Error updating book: " . mysqli_error($con);
        }
    }

    ?>


</body>

</html>