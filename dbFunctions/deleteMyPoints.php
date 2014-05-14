<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$notMyPoints = $_POST["notMyPoints"];

require_once 'db.php';
$db = connectDatabase();
$delete = 'DELETE FROM POINT WHERE idGoals = :idGoals';
$stmt = $db->prepare($delete);
foreach ($notMyPoints as $idGoals) {
   $stmt->bindValue(':idGoals', $idGoals);
   $success = $stmt->execute();
}

if ($success) {
    header("Location: http://ps11.pstcc.edu/~c2530a11/GreenOffice/myPoints.php");

}
 else {
     header("Location: http://ps11.pstcc.edu/~c2530a11/GreenOffice/index.php");
}








