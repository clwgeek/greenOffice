<?php
session_name('greenOffice');
session_start();
//error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Leaf One</title>

        <?php
        require_once 'dbFunctions/headCommon.php';
        require_once 'dbFunctions/db.php';
        require_once 'writeHTML/loadWorksheet.php';
        include_once 'writeHTML/pageTop.php';
        ?>
       
    </head>
    <body>
        <?php navbar('leaf1'); ?>
       
       
            <?php
            jumbotron('Leaf One');
            ?>
       
        <div class="container-fluid">   
            <form action="dbFunctions/points.php" class="form-inline" method="POST">
                <div class="row-fluid">
                    <?php
                    $db = connectDatabase();
                    getCategories(1, $db);
                    ?>
                    <br />
                    <button type="submit" class="btn btn-large btn-success">Save my points</button>
                </div>

            </form>
        </div>
    </body>
</html>
