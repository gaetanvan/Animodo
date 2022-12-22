<?php

use class\Pdo;

session_start();
$db = new PDO('mysql:host=localhost;dbname=animodo', 'root', '');
if (!$_SESSION['password']){
    header('Location:index.php');
}
if (isset($_GET['id']) AND $_GET['id'] > 0){
    $getId = intval($_GET['id']);
    $reqUser = $db->prepare('SELECT * FROM user where userID = ?');
    $reqUser->execute(array($getId));
    $userInfo = $reqUser->fetch();

    $sql = "SELECT * FROM user";
    $request = $db->query($sql);
    $user = $request->fetchAll();

    $petSql ="SELECT * FROM animaux where userID = :id";
    $petRequest = $db->prepare($petSql);
    $petRequest->bindValue(":id",$getId, PDO::PARAM_INT);
    $petRequest->execute();
    $petInfo = $petRequest->fetchAll();
}
else {
    header :'Location:admin.php?id='.$_SESSION['userID'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Animodo</title>
    <link rel="stylesheet" type="text/css" href="css/acceuil.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
<div id="rectangle-color" class="rectangle2">
    <?php foreach($user as $user): ?>
        <div class="user">
            <p name='name'><?php echo $user['name']; ?><br>3 animaux</p>
            <a href="petAdmin.php?id=<?php echo $user['userID'] ?>"><button>Accéder</button></a>
        </div>
    <?php endforeach; ?>
</div>
<div id="rectangle-color" class="adminRectangle">
    <div class="userAdd">
        <a href="userCreate.php">
            <button>Nouvelle utilisateur</button>
        </a>
    </div>
    <?php foreach($petInfo as $petInfo): ?>
    <a id="petInfo" class="link" href="petAdmin.php">
        <div class="pet1">
            <img class="petimg" src="img/chat.jpg">
            <p class="name">Nom : chat1</p>
            <p class="age">Age : 3 ans<br>Poids : 15kg</p>
            <p class="meetings">Prochain vaccin : 20/07/1999</p>
        </div>
    </a>
    <?php endforeach; ?>
</div>
</body>
<footer>
    <a href="logout.php" ><button name="logout">Logout</button></a>
</footer>