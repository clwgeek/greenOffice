<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);

$idGoals = $_POST["idGoals"];
$leaf = $_POST["leafNumber"];
$leafNumber = 10 + $leaf;
require_once 'db.php';
$db = connectDatabase();
$message = "";
//must do soft delete or would wipe out the goal for the user point info

$soft = 'UPDATE `GOAL` WHERE `idGoals` = :idGoals SET `leafNumber`=:leafNumber';

$stmt = $db->prepare($soft);

$stmt->bindValue(':idGoals', $idGoals);
$stmt->bindValue('leafNumber', $leafNumber);
$success = $stmt->execute();

if ($success) {
    $message = 'Your goal was successfully deleted';
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Updated item</title>

        <?php
        require_once 'headPathFix.php';
        require_once 'db.php';
        ?>
    </head>
    <body>
        <div class="container-fluid"> 

            <h3>
                <?php echo $message; ?>
            </h3>
            <a href="../adminForm.php" class="btn btn-large btn-primary disabled">Back to Form</a>
            <a href="../index.php" class="btn btn-large btn-primary disabled">Home Page</a>


        </div>
    </body>
</html>
