<?php
session_start();
if (!$_SESSION['password']) {
    header('Location:index.php');
}

$bdd = new PDO('mysql:host=localhost;dbname=animodo;charset=utf8', 'root', '');

if (isset($_POST['create'])) {
    if (!empty($_POST['petName']) && !empty($_POST['petWeight']) && !empty($_POST['petAge'])) {
        $petName = htmlspecialchars($_POST['petName']);
        $petWeight = htmlspecialchars($_POST['petWeight']);
        $petAge = $_POST['petAge'];
        $getId = intval($_GET['id']);
        $insertUser = $bdd->prepare('INSERT INTO animaux (petName, petWeight, petAge , userID) VALUES (? , ? , ? , ?)');
        $insertUser->execute(array($petName , $petWeight, $petAge, $getId));
        header('Location:petAdmin.php?id='.$getId);
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
        <div class="petName">
            <input type="text" name="petName" placeholder="Nom de l'animal" required>
        </div>
        <div class="petAge">
            <input type="text" name="petAge" placeholder="Age de l'animal" required>
        </div>
        <div class="petWeight">
            <input type="text" name="petWeight"  placeholder="Poids de l'animal" required>
        </div>
        <div class="register">
            <button name="create">Créer</button>
        </div>
    </form>
</div>
</body>

