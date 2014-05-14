<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
if (!isset($_SESSION['roll'])||$_SESSION['roll']<4){
    require 'index.php';
    exit(); 
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Worksheet editor</title>
        <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />

        <?php
        require_once 'dbFunctions/headCommon.php';
        require_once 'dbFunctions/db.php';
        include_once 'writeHTML/pageTop.php';
        require 'writeHTML/loadEditor.php';
        ?>
    </head>
    <body>
        <div class="container-fluid"> 

            <?php
            navbar('adminWorksheet');
            jumbotron('Edit Worksheet');
            $db = connectDatabase();
            ?>
        </div>
        <div class="container-fluid">
            <br />
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#leaf1" data-toggle="tab">Leaf 1</a></li>
                <li><a href="#leaf2" data-toggle="tab">Leaf 2</a></li>
                <li><a href="#leaf3" data-toggle="tab">Leaf 3</a></li>
                <li><a href="#leaf4" data-toggle="tab">Leaf 4</a></li>
                <li><a href="#wildcard" data-toggle="tab">Wildcard</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="leaf1">                   
                    <h3> Leaf 1</h3>
                    <div class="row-fluid">
                        <?php                                    showCurrent('1', $db);?>
                    </div>                       
                </div>
                <div class="tab-pane" id="leaf2">
                    <h3>Leaf 2</h3>
                   <div class="row-fluid">
                        <?php                                    showCurrent('2', $db);?>
                    </div>
                </div>
                <div class="tab-pane" id="leaf3">
                    <h3>Leaf 3</h3>
                     <div class="row-fluid">
                        <?php                                    showCurrent('3', $db);?>
                    </div>               
                </div>  
                <div class="tab-pane" id="leaf4">
                    <h3>Leaf 4</h3>
                     <div class="row-fluid">
                        <?php                                    showCurrent('4', $db);?>
                    </div>                   
                </div>
                <div class="tab-pane" id="wildcard">
                    <h3>Wildcard</h3>
                    <div class="row-fluid">
                        <?php                                    showCurrent('0', $db);?>
                    </div>
                </div>
            </div>         
            <script>
                $(function() {
                    $('#myTab a:last').tab('show');
                });
            </script>
        </div>
    </body>
</html>