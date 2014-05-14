<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);

// to populate a single users points

function loadMyPoints($leafNumber, $db) {
    if (isset($_SESSION['leming'])) {
        $idUser = $_SESSION['leming'];
    } else {
        echo'<h3> Please Login to see your points</h3>';
        exit();
    }

    $leaf = intval($leafNumber);
    $oldLeaf = $leaf +10;
    $query = "SELECT DISTINCT category FROM GOAL WHERE leafNumber = $leaf;";
    $result = $db->query($query);
    $categories = $result->fetchAll();

    $result->closeCursor();
    
    $myP = "SELECT idGoals FROM POINT WHERE idFromUser = $idUser";
    $r = $db->query($myP);
    $myGoals = $r->fetchAll();

    foreach ($categories as $cat):

        $category = $cat['category'];
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" >
                <h3 class="panel-title">
                    <?php echo $category ?></h3> 
                <hr size="3" />
            </div>
            <div class="panel-body" >
                <?php
                foreach ($myGoals as $myGoal):
                    $idGoals = $myGoal['idGoals'];
                    $query = "SELECT * FROM GOAL WHERE (category = '$category' AND (leafNumber = $leaf || leafNumber = $oldLeaf) AND idGoals = $idGoals);";
                    $goals = $db->query($query);

                    foreach ($goals as $goal):
                        ?>
                        <div class="row-fluid">

                            <div class="span9">
                                <h5><?php echo trim($goal['description']); ?></h5>
                                <?php
                                if (!empty($goal['webLink1'])) {
                                    echo trim($goal['webLink1Text']) . "  ";
                                    ?>
                                    <a href="<?php echo $goal['webLink1']; ?>" target="_blank" ><?php echo trim($goal['webLink1']); ?> </a> 
                                    <?php
                                }
                                if (!empty($goal['webLink2'])) {
                                    echo trim($goal['webLink1Text']) . "  "
                                    ?>
                                    <a href="<?php echo $goal['webLink2']; ?>" target="_blank" ><?php echo trim($goal['webLink2']); ?> </a> 
                                    <?php
                                }
                                if (!empty($goal['webLink3'])) {
                                    echo trim($goal['webLink3Text']) . "  "
                                    ?>
                                    <a href="<?php echo trim($goal['webLink3']); ?>" target="_blank" ><?php echo trim($goal['webLink3']); ?> </a>                             
                                    <?php
                                }
                                if (!empty($goal['otherNotes'])) {
                                    echo trim($goal['otherNotes']);
                                }
                                ?>
                                <hr /> 
                            </div>
                            <div class="span2">
                                <i class="icon-trash icon-white"></i>
                                <label class="checkbox inline">Delete from My Points </label>
                                <input type ="checkbox"  name="notMyPoints[]" value="<?php echo $goal['idGoals']; ?>">                      

                            </div>
                        </div>

                        <?php
                    endforeach;
                endforeach;
                ?>
            </div> 


        </div>
    <?php
    endforeach;
}


