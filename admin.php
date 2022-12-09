<?php
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
<div id="rectangle-color" class="rectangle2Admin">
    <div class="userAdd">
        <a href="userCreate.php">
            <button class="button">Nouvelle utilisateur</button>
        </a>
    </div>
    <?php foreach($user as $user): ?>
        <div class="user">
            <p name='name'><?php echo $user['name']; ?><br>3 animaux</p>
            <a href="petAdmin.php?id=<?php echo $user['userID'] ?>"><button>Accéder</button></a>
        </div>
    <?php endforeach; ?>
    <a href="logout.php" ><button name="logout" class="button">Logout</button></a>
</div>
<div id="rectangle-color" class="adminRectangle">
    <div class="petAdd">
        <a href="petCreate.php?id=<?php echo $getId ?>">
            <button class="button">Nouvel animal</button>
        </a>
    </div>
</div>
</body>
<footer>
</footer>