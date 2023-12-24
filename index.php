<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./header.css">
    <link rel="stylesheet" href="./footer.css">
    <title>BookHaven</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="icon" href="./images/logo2.png" type="image/x-icon">
    <script>
        function runChangeData() {
            setInterval(() => {
                let randomNumber = Math.floor(Math.random() * (5 - 1 + 1)) + 1;
                let image = document.getElementById("home_wrapper_1_image");
                image.src = `./images/booksForHome/${randomNumber}.jpg`;

            }, 1000)
        }

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
<div class="header">
       
    </div>
<body onload="runChangeData()">
    <div class="hero_container">
        <div class="hero_wrapper_1">
            <?php include("./components/header.php") ?>
        </div>

        <div class="hero_wrapper_2">
            <h3 id="heroText">“To learn to read is to light a fire; every syllable that is spelled out is a spark.” ― Victor Hugo</h3>
            <img src="./images/hero1.png" alt="hero1" class="hero_image_1">
        </div>
        <img src="./images/wave.png" class="hero_wave_1" />
    </div>

    <div class="home_container_1">
        <h1>Why Choose Us ?</h1>
        <div class="home_wrapper_1">
            <p>Discover a world of literary wonders as you explore our website, where you can find a variety of all book genres to read from. Experience the joy of reading like never before by choosing books from our curated collection that spans diverse categories. Enjoy the convenience of doorstep delivery, coupled with exclusive discounts and promotions, making your book-buying experience both delightful and cost-effective. Elevate your reading adventure with us and immerse yourself in the world of captivating stories that await on our user-friendly platform.</p>
            <img src="./images/booksForHome/1.jpg" alt="books" id="home_wrapper_1_image">
        </div>



        <div class="home_container_2">
            <h1>What We Offer</h1>
            <div class="home_wrapper_2">
                <span>Delivery all over Lebanon</span>
                <span>No delivery charge on orders</span>
                <span>Quality A Books</span>
            </div>
        </div>
    </div>
    <img src="./images/wave-2.png" class="hero_wave_2" />
</body>

</html>