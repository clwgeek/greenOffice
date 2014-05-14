<?php
session_name('greenOffice');
//session_set_cookie_params(0, '~c2530a11/GreenOffice', '.ps11.pstcc.edu');
session_start();
error_reporting(E_ALL ^ E_NOTICE);

function jumbotron($pageName) {
    if (isset($_SESSION['firstName'])) {
        $firstName = $_SESSION['firstName'];
        $welcome = 'Welcome, ' . $firstName;
    } else {
        $welcome = '<a href="index.php" class="btn btn-success btn-block" role="button" >Login</a>';
    }
    ?>
    <a href="index.php" ></a>
    <div class="container">
        <div style='background-color: #b0bf9a' >

            <div class="page-header" style="margin-bottom: 5px" >
                <div class="row-fluid">
                    <div class="span3">
                        <img src="img/leaf.gif" class="img-responsive hidden-phone" alt="suststainability leaf"/>
                    </div>
                    <div class="span6" >
                        <h1 align='center' style="color: #0e2a0f">Green Office Challenge</h1>
                        <h2 align='center' style="color: #0e2a0f"><?php echo $pageName; ?>
                        </h2>
                    </div>
                    <div class="span3 pull-right" >
                        <img src="img/pstcc.gif" class="img-responsive hidden-phone" alt="Pellissippi State"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="container">
            <div class="span2"> 
                <?php echo $welcome; ?>
            </div>
            <div class="span8" align="center">
                <p> 
                    Check off items as you Green your Office, 
                    save your points at the bottom of the form. 
                    <br />
                    <i class="icon-leaf icon-white">
                    </i>&nbsp;this item is required&nbsp;&nbsp; 

                    <i class="icon-home icon-white"></i>&nbsp;
                    you may get points for this if not available to you
                </p>
            </div>
            <div class="span2 pull-right">                
                <a href="sessionKill.php" class="btn btn-danger btn-block" role="button" >Logout</a>
            </div>
        </div>
    </div>

    <?php
}

//
function navbar($currentPage) {
    ?>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="brand" href="index.php">Green Office</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <?php
                        if ($currentPage == "index") {
                            ?>
                            <li class="active"><a href="index.php">Home</a></li>
                        <?php } else {
                            ?>
                            <li ><a href="index.php">Home</a></li>
                            <?php
                        }
                        if ($currentPage == "leaf1") {
                            ?>
                            <li class="active"><a href="leaf1.php">Leaf 1</a></li>
                        <?php } else {
                            ?>
                            <li ><a href="leaf1.php">Leaf 1</a></li>
                            <?php
                        }
                        if ($currentPage == "leaf2") {
                            ?>
                            <li class="active"><a href="leaf2.php">Leaf 2</a></li>
                        <?php } else {
                            ?>
                            <li><a href="leaf2.php">Leaf 2</a></li>
                            <?php
                        }
                        if ($currentPage == "leaf3") {
                            ?>
                            <li class= "active"><a href="leaf3.php">Leaf 3</a></li>
                        <?php } else {
                            ?>
                            <li><a href="leaf3.php">Leaf 3</a></li>
                            <?php
                        }
                        if ($currentPage == "leaf4") {
                            ?>
                            <li class="active"><a href="leaf4.php">Leaf 4</a></li>
                        <?php } else { ?>
                            <li><a href="leaf4.php">Leaf 4</a></li>
                            <?php
                        }
                        if ($currentPage == "wildcard") {
                            ?>
                            <li class="active"><a href="wildcard.php">Wildcard</a></li>
                        <?php } else { ?>
                            <li><a href="wildcard.php">Wildcard</a></li>
                            <?php
                        }
                        if ($currentPage == "myPoints") {
                            ?>
                            <li class="active"><a href="myPoints.php">My Points</a></li>
                        <?php } else { ?>
                            <li><a href="myPoints.php">My Points</a></li>
                        <?php } ?>
                    </ul> 
                    <ul class="nav pull-right">

                        <form class="navbar-form ">
                            <li >

                                <input type="button" class="btn-block btn-success" 
                                       value="Click here to search" 
                                       onclick="searchPrompt('green', true, 'blue', 'yellow');"> 
                            </li>
                        </form>
                    </ul>
                </div> <!--navbar-collapse-->
            </div>  <!--navbar-->
        </div>
    </div>


    <?php
}
?>
