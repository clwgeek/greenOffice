<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once 'db.php';
$db = connectDatabase();

$deptNew = $_POST["editName"];
$department = $_POST["department"];

$update = 'UPDATE DEPARTMENT USER SET department = :deptNew WHERE department = :department';
try {
    $stmt = $db->prepare($update);
//bindValue protects against sql insertion
    $stmt->bindValue(':department', $department);
    $stmt->bindValue(':deptNew', $deptNew);

    $success = $stmt->execute();
    $stmt->closeCursor();
} catch (Exception $exc) {
    $message = "There was a problem editing your department: $exc";
}

if ($success) {
    $message = "Thank you for editing a department.";
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

