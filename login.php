<?php
    session_start();
    if (!$_SESSION['password']){
        header('Location:index.php');
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Animodo</title>
        <link rel="stylesheet" type="text/css" href="css/acceuil.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
        <div id="rectangle-color" class="rectangle1">
            <div class="pet1">
                <img class="petimg" src="img/chat.jpg">
                <p class="name">Nom : chat1</p>
                <p class="age">Age : 3 ans<br>Poids : 15kg</p>
                <p class="meetings">Prochain vaccin : 20/07/1999</p>
            </div>
        </div>
        <div id="rectangle-color" class="rectangle2">
            <h2>Rendez-Vous :</h2>
            <p class="name">Nom : chat1</p>
        </div>
    </body>
    <footer>
            <a href="logout.php" ><button name="logout">Logout</button></a>
    </footer>
