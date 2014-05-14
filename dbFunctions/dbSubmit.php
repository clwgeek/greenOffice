<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once 'db.php';
$db = connectDatabase();
$leafNumber = $_POST["leafNumber"];
$category = $_POST["category"];
$description = $_POST["description"];
$leafPoints = $_POST["points"];
$webLink1 = $_POST["webLink1"];
$webLink1Text = $_POST["webLink1Text"];
$webLink2 = $_POST["webLink2"];
$webLink2Text = $_POST["webLink2Text"];
$webLink3 = $_POST["webLink3"];
$webLink3Text = $_POST["webLink3Text"];
$otherNotes = $_POST["otherNotes"];
$required = $_POST["required"];
$availability = $_POST["availability"];
$message = NULL;


if ($required==null){
    $required = FALSE;
}
if ($availability==null){
    $availability = FALSE;
}


if ((filter_var($webLink1, FILTER_VALIDATE_URL) == FALSE) && ($webLink1 !=null)) {
    $message = $message . "Your url is not valid in the first weblink, only enter url put other text in notes.";
}
if ((filter_var($webLink2, FILTER_VALIDATE_URL) == FALSE) && ($weblink2 !=null)){
    $message = $message . "Your url is not valid in the second weblink, only enter url put other text in notes.";
}
if ((filter_var($webLink3, FILTER_VALIDATE_URL) == FALSE) && ($webLink3 !=null)){
    $message = $message . "Your url is not valid in the third weblink, only enter url put other text in notes.";
}

$insert = 'INSERT INTO GOAL (category, description, leafNumber, leafPoints, '
        . 'webLink1, webLink1Text, webLink2, webLink2Text, webLink3, webLink3Text, '
        . 'otherNotes, required, availability) VALUES (:category, :description, :leafNumber, :leafPoints, '
        . ':webLink1, :webLink1Text, :webLink2, :webLink2Text, :webLink3, :webLink3Text, :otherNotes, :required, :availability)';

$stmt = $db->prepare($insert);
//bindValue protects against sql insertion
$stmt->bindValue(':category', trim($category));
$stmt->bindValue(':description', trim($description));
$stmt->bindValue(':leafNumber', trim($leafNumber));
$stmt->bindValue(':leafPoints', trim($leafPoints));
$stmt->bindValue(':webLink1', trim($webLink1));
$stmt->bindValue(':webLink1Text', trim($webLink1Text));
$stmt->bindValue(':webLink2', trim($webLink2));
$stmt->bindValue(':webLink2Text', trim($webLink2Text));
$stmt->bindValue(':webLink3', trim($webLink3));
$stmt->bindValue(':webLink3Text', trim($webLink3Text));
$stmt->bindValue(':otherNotes', trim($otherNotes));
$stmt->bindValue(':required', $required);
$stmt ->bindValue(':availability', $availability);

if ($message == null) {
    $success = $stmt->execute();
}

if ($success) {
    $message = "Thank you for entering a new item.";
}

//$stmt->closeCursor;

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
