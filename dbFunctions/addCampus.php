<?php
session_name('greenOffice');
session_start();
require_once 'db.php';
$db = connectDatabase();

$campusName = $_POST['campName'];
$campus = $_POST['campus'];


$insert = 'INSERT INTO CAMPUS (campus, campusName) VALUES (:campus, :campusName)';
try {
    $stmt = $db->prepare($insert);
//bindValue protects against sql insertion
    $stmt->bindValue(':campus', $campus);
    $stmt->bindValue(':campusName', $campusName);

    $success = $stmt->execute();
    $stmt->closeCursor();
} catch (Exception $exc) {
    $message = "There was a problem creating your campus: $exc";
}

if ($success) {
    $message = "Thank you for adding a campus.";
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Success</title>

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

