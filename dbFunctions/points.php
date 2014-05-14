<?php
session_name('greenOffice');
session_start();
//error_reporting(E_ALL ^ E_NOTICE);
require_once 'db.php';
$db = connectDatabase();
//$points = array();
$points = $_POST['myPoints'];
//$availabilities = array();
$availabilities = $_POST['myAvailability'];
$idUser = $_SESSION['leming'];
$leafLevel = $_SESSION['leafLevel'];

$insert = 'INSERT INTO POINT (idGoals, idFromUser, pointsCurrentLeafLevel, availability)VALUES (?,?,?,?)';
$stmt = $db->prepare($insert);
try {
//this is a terible way but may work for now
    foreach ($points as $point) {
        echo $point;
        if (empty($availabilities)) {
            $avb = 0;
        } elseif (in_array($point, $availabilities)) {
            $avb = 1;
        } else {
            $avb = 0;
        }
        echo $avb;
        $stmt->bindParam(1, $point);
        $stmt->bindParam(2, $idUser);
        
        $stmt->bindParam(3, $leafLevel);
        $stmt->bindParam(4, $avb);

        $stmt->execute();
    }
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
    exit();
}
//require '../myPoints.php';

header('Location: ../myPoints.php');

