<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=animodo', 'root', '');
if (!$_SESSION['password']){
    header('Location:index.php');
}
$petId = $_GET['petid'];
$getId = $_GET['id'];

$mailSql = "SELECT * FROM meetings INNER JOIN animaux WHERE meetings.petID = '$petId' = animaux.petID";
$mailRequest = $db->prepare($mailSql);
$mailRequest->execute();
$mailInfo = $mailRequest->fetch();

$adressSql = "SELECT mail FROM user WHERE userID = '$getId'; ";
$adressRequest = $db->prepare($adressSql);
$adressRequest->execute();
$adressInfo = $adressRequest->fetch();

$to = $adressInfo['mail'];
$subject  = 'Rappel rendez-vous vaccin';
$message = 'Vous avez rendez-vous le '.$mailInfo['meetingDate'].' pour le vaccin de votre animaux : '.$mailInfo['petName'];

mail($to, $subject,$message);

header('Location:petAdmin.php?id='.$getId);