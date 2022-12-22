<?php
    session_start();
    $db = new PDO('mysql:host=localhost;dbname=animodo', 'root', '');
    if (!$_SESSION['password']){
        header('Location:index.php');
    }
    $getId = intval($_GET['id']);
    $petSql ="SELECT * FROM animaux where userID = :id";
    $petRequest = $db->prepare($petSql);
    $petRequest->bindValue(":id",$getId, PDO::PARAM_INT);
    $petRequest->execute();
    $petInfo = $petRequest->fetchAll();
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
        <div id="rectangle-color" class="adminRectangle">
            <?php foreach($petInfo as $petInfo): ?>
                <div class="petRectangle">
                    <div class="pet1">
                        <img class="petimg" src="img/chat.jpg">
                        <p class="name">Nom : <?php echo $petInfo['petName']; ?></p>
                        <p class="age">Age : <?php echo $petInfo['petAge']; ?> ans<br>Poids : <?php echo $petInfo['petWeight']; ?>kg</p>
                        <p class="meetings">Prochain vaccin : <?php
                            $meetingsRequest = $db->prepare("SELECT * FROM meetings where petID = ?");
                            $meetingsRequest->execute(array($petInfo['petID']));
                            $meetingsInfo = $meetingsRequest->fetch();
                            if (isset($meetingsInfo['meetingDate'])){
                                echo $meetingsInfo['meetingDate'];}
                            else{
                                echo 'Pas de rendez-vous';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div id="rectangle-color" class="rectangle2">
            <h2>Rendez-Vous :</h2>
            <p class="name"><?php
                $meetingsRequest = $db->prepare("SELECT * FROM meetings where petID = ?");
                $meetingsRequest->execute(array($petInfo['petID']));
                $meetingsInfo = $meetingsRequest->fetch();
                if (isset($meetingsInfo['meetingDate'])){
                    echo $meetingsInfo['meetingDate'];}
                else{
                    echo 'Pas de rendez-vous';
                }
                ?></p>

        </div>
    </body>
    <footer>
        <a href="logout.php" ><button name="logout" class="button">Logout</button></a>
    </footer>
