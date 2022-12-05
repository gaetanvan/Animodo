<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animodo</title>
    <link rel="stylesheet" type="text/css" href="css/acceuil.css">
</head>
<body>
<h1>Animodo</h1>
<?php
if (isset($_SESSION['mail']))
{
    echo "<center><h2>Vous êtes connecté :" . $_SESSION['mail'] . "</h2></center>";
}
else
{
    ?>
    <form method="POST" action="login.php">
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
    <?php
}
?>
</body>
</html>

