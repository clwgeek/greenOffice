<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Leaf Three</title>

        <?php
        require_once 'dbFunctions/headCommon.php';
        require_once 'dbFunctions/db.php';
        require_once 'writeHTML/loadWorksheet.php';
        include_once 'writeHTML/pageTop.php';
        ?>
    </head>
    <body>
        <div class="container-fluid"> 

            <?php
            navbar('leaf3');
            jumbotron('Leaf Three');
            ?>
            <form action="dbFunctions/points.php" method="POST">
                <div class="row-fluid">
                    <?php
                    $db = connectDatabase();
                    getCategories(3, $db);
                    ?>
                    <br />
                    <button type="submit" class="btn btn-large btn-success">Save my points</button>
                </div>
            </form>
        </div>
    </body>
</html>
