<?php
error_reporting(E_ALL ^ E_NOTICE);
function jumbotron($pageName) { ?>
    <div style='background-color: #b0bf9a' > 
        <div class="container">
            <div class="page-header"  >
                <div class="row">               
                    <div class="span3"><br />
                        <img src="../img/leaf.gif" class="img-responsive hidden-phone" alt="suststainability leaf"/> 
                    </div>
                    <div class="span6" >
                        <h1 align='center' style="color: #0e2a0f"> Green Office Challenge</h1>                        
                        <h2 align='center' style="color: #0e2a0f"><br /><?php echo $pageName; ?>
                        </h2> 
                    </div>
                    <div class="span3" ><br />
                        <img src="../img/pstcc.gif" class="img-responsive hidden-phone" alt="Pellissippi State"/> 
                        
                    </div>               
                </div>	 		
            </div> 
        </div>
    </div>
    <?php
}

function navbar($currentPage) {
    ?>
    <div class="navbar navbar-static-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="../index.php">Green Office</a>

                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <?php
                        if ($currentPage == "index") {
                            ?>
                            <li class="active"><a href="../index.php">Home</a></li>
                        <?php } else {
                            ?>
                            <li ><a href="../index.php">Home</a></li>
                            <?php
                        }
                        if ($currentPage == "leaf1") {
                            ?>
                            <li class="active"><a href="../leaf1.php">Leaf 1</a></li>
                        <?php } else {
                            ?>
                            <li ><a href="../leaf1.php">Leaf 1</a></li>
                            <?php
                        }
                        if ($currentPage == "leaf2") {
                            ?>
                            <li class="active"><a href="../leaf2.php">Leaf 2</a></li>
                        <?php } else {
                            ?>
                            <li><a href="../leaf2.php">Leaf 2</a></li>                
                            <?php
                        }
                        if ($currentPage == "leaf3") {
                            ?>
                            <li class= "active"><a href="../leaf3.php">Leaf 3</a></li>                         
                        <?php } else {
                            ?>
                            <li><a href="../leaf3.php">Leaf 3</a></li>
                            <?php
                        }
                        if ($currentPage == "leaf4") {
                            ?>
                            <li class="active"><a href="../leaf4.php">Leaf 4</a></li>
                        <?php } else { ?>
                            <li><a href="../leaf4.php">Leaf 4</a></li>
                            <?php
                        }
                        if ($currentPage == "wildcard"){
                            ?>
                            <li class="active"><a href="../wildcard.php">Wildcard</a></li>
                        <?php } else { ?>
                            <li><a href="../wildcard.php">Wildcard</a></li>
                        <?php                        
                        }
                        if ($currentPage == "myPoints") {
                            ?>
                            <li class="active"><a href="../myPoints.php">My Points</a></li>
                            <?php } else { ?>
                            <li><a href="../myPoints.php">My Points</a></li>
                        <?php }
                        ?>

                    </ul>  
                </div> <!--navbar-collapse-->
            </div>  <!--navbar-->
        </div> 
    </div>

    <?php
}
?>   
