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

    <div class="book_container">
        <div class="book_image_container">
            <img class="book_image" src="./images/booksForHome/2.jpg" />
        </div>
        <div class="book_details_container">
            <h1>Title</h1>
            <div>
                <h4>
                    Genre: Psychology <br />
                    Date: 1971<br />
                    Author: Albert Camus<br /><br /><br />
                </h4>
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam ullam eligendi a ad sint. Totam, sint quibusdam laborum minima veniam laudantium! Et earum culpa corrupti quidem ea nisi dolorem provident pariatur. Ex iste officia asperiores est perspiciatis debitis architecto deleniti accusantium, ipsum reiciendis nesciunt commodi doloremque maiores omnis vitae repudiandae praesentium minus voluptatibus ut ab cum repellendus inventore officiis? Labore commodi dolores voluptatibus provident, quia tenetur voluptas aperiam voluptates, sint molestias eius. Blanditiis cupiditate corrupti hic officiis error assumenda beatae molestiae sed obcaecati ad porro alias rem laborum, placeat unde omnis. Esse, error! A reprehenderit libero possimus corrupti ullam aliquid dolorem aut expedita! Fugit, cum? Distinctio magni ratione rerum nesciunt illum est exercitationem id odio reiciendis, ab fugit, nobis, sed quisquam aliquam pariatur quos aperiam fuga quia optio necessitatibus. Unde eaque, dolores nulla alias doloribus adipisci quidem nisi quam quasi soluta ullam veritatis aperiam quod impedit molestias beatae atque saepe fugit omnis rerum suscipit modi qui? Rem ducimus provident delectus! Amet et hic, ipsam atque laudantium impedit reprehenderit culpa enim quod possimus unde odio dicta error obcaecati dolore, laborum aliquam vitae consectetur voluptatum provident molestiae iure quisquam nostrum! Exercitationem iusto distinctio quod iste culpa blanditiis asperiores praesentium ea quae veritatis autem animi cum provident sit, in deserunt accusantium alias officia nobis quidem dolores odit. Possimus repudiandae incidunt error quibusdam consequatur, blanditiis animi necessitatibus, assumenda nisi ratione voluptate cumque magnam sit ipsum distinctio ex. Adipisci odit enim modi eos atque eligendi harum voluptatibus quidem debitis labore ad, voluptatum fugit iusto omnis blanditiis eaque tempora nihil doloremque illum, facere provident veritatis quas cumque! Optio consequatur molestiae nemo expedita accusantium explicabo fugit voluptate quos eius debitis iste nostrum corporis, dicta ipsum exercitationem culpa nulla dignissimos. Necessitatibus molestiae temporibus deleniti obcaecati ipsa praesentium odit repellat, porro nesciunt dolorem dolore explicabo fugiat modi similique repellendus.</p>
        </div>
    </div>

</body>

</html>