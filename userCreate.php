<?php

use class\Pdo;

session_start();
if (!$_SESSION['password']) {
    header('Location:index.php');
}

$bdd = new PDO('mysql:host=localhost;dbname=animodo;charset=utf8', 'root', '');

if (isset($_POST['register'])) {
    if (!empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
        $name = htmlspecialchars($_POST['name']);
        $mail = htmlspecialchars($_POST['mail']);
        $password = password_hash($_POST['password'] , PASSWORD_DEFAULT);
        $admin = $_POST['admin'];
        $insertUser = $bdd->prepare('INSERT INTO user (name, mail, password, admin) VALUES (? , ? , ? , ?)');
        $insertUser->execute(array($name , $mail, $password , $admin));
        header('Location:admin.php?id='.$_SESSION['userID']);
    } else {
        echo "Veuillez completer tous les champs..";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animodo</title>
    <link rel="stylesheet" type="text/css" href="css/acceuil.css">
</head>
<body>
    <div>
        <form class="createRectangle" method="POST" action="">
            <h2>Inscription</h2>
            <div class="name">
                <input type="text" name="name" placeholder="Nom" required>
            </div>
            <div class="username">
                <input type="text" name="mail" placeholder="Mail" required>
            </div>
            <div class="password">
                <input type="password" name="password"  placeholder="Mot de passe" required>
            </div>
            <div class="admin">
                <select name="admin" size=1>
                    <option>user
                    <option>admin
                </select>
            </div>
            <div class="register">
                <button name="register">Register</button>
            </div>
        </form>
    </div>
</body>
