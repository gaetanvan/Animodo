<?php
session_start();

if (isset($_POST['submit']))
{
    $mail = htmlspecialchars($_POST['mail']);
    $pass = $_POST['pass'];

    $db = new PDO('mysql:host=localhost;dbname=animodo', 'root', '');

    $sql = "SELECT * FROM user where mail = '$mail'";
    $result = $db->prepare($sql);
    $result->execute();

    if ($result->rowCount() > 0)
    {
        $data = $result->fetchAll();
        if (password_verify($pass , $data[0]['password'])){
            if ($data[0]['admin'] == "user") {
                $_SESSION['mail'] = $data[0]['mail'];
                $_SESSION['password'] = $data[0]['password'];
                $_SESSION['userID'] = $data[0]['userID'];
                header('Location:login.php?id='.$_SESSION['userID']);
            }
            elseif ($data[0]['admin'] == "admin") {
                $_SESSION['mail'] = $mail;
                $_SESSION['password'] = $pass;
                $_SESSION['userID'] = $data[0]['userID'];
                header('Location:admin.php?id='.$_SESSION['userID']);
            }
        }
    }
    else
    {
        echo 'Mot de passe ou mail incorrect.';
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
<h1>Animodo</h1>
    <form method="POST" action="">
        <div class="center">
            <div class="username">
                <input type="text" name="mail" placeholder="Mail" required>
            </div>
            <div class="password">
                <input type="password" name="pass"  placeholder="Mot de passe" required>
            </div>
            <div class="login">
                <button name="submit">Login</button>
            </div>
        </div>
    </form>
</body>
</html>