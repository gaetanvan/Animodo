<?php
session_start();
if (!$_SESSION['password']) {
    header('Location:index.php');
}
$db = new PDO('mysql:host=localhost;dbname=animodo;charset=utf8', 'root', '');

if (isset($_GET['id']) AND $_GET['id'] > 0){
    $getPetID = intval($_GET['petid']);
    $petSql ="SELECT * FROM animaux where petID = :id";
    $petRequest = $db->prepare($petSql);
    $petRequest->bindValue(":id",$getPetID, PDO::PARAM_INT);
    $petRequest->execute();
    $petInfo = $petRequest->fetch();
}

if (isset($_POST['create'])) {
    if (!empty($_POST['petName']) && !empty($_POST['petWeight']) && !empty($_POST['petAge'])) {
        $petName = htmlspecialchars($_POST['petName']);
        $petWeight = htmlspecialchars($_POST['petWeight']);
        $petAge = $_POST['petAge'];
        $meetingDate = $_POST['petMeeting'];
        $getId = intval($_GET['id']);
        $insertPet = $db->prepare('UPDATE animaux SET petName = ? , petWeight = ?, petAge = ?, userID = ? WHERE petID = ?');
        $insertPet->execute(array($petName, $petWeight, $petAge, $getId , $getPetID));
        $insertMeeting = $db->prepare('INSERT INTO meetings (petID , meetingDate) VALUES (? , ?)');
        $insertMeeting->execute(array($getPetID, $meetingDate));
        header('Location:petAdmin.php?id=' . $getId);
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
        <h2>Modifier</h2>
        <div class="petName">
            <label class="textCenter" for="petName">Nom de l'animal :</label>
            <br>
            <input type="text" name="petName" placeholder="Nom de l'animal" value="<?php echo $petInfo['petName']; ?>" required>
        </div>
        <div class="petAge">
            <label class="textCenter" for="petAge"> Age de l'animal :</label>
            <br>
            <input type="text" name="petAge" placeholder="Age de l'animal" value="<?php echo $petInfo['petAge']; ?>" required>
        </div>
        <div class="petWeight">
            <label class="textCenter" for="petWeight"> Poids de l'animal :</label>
            <br>
            <input type="text" name="petWeight"  placeholder="Poids de l'animal" value="<?php echo $petInfo['petWeight']; ?>" required>
        </div>
        <div class="petMeeting">
            <label class="textCenter" for="petMeeting"> Prochain vaccin :</label>
            <br>
            <input type="date" name="petMeeting"  placeholder="Prochain vaccin" value="" required>
        </div>
        <div class="register">
            <button name="create">Créer</button>
        </div>
    </form>
</div>
</body>
