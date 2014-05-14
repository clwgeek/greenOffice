<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
function showCurrent($leaf, $db) {

    $query = "SELECT DISTINCT category FROM GOAL WHERE leafNumber = $leaf;";
    $categories = $db->query($query);
    ?>
    <div class = "row-fluid" >
        <?php
        foreach ($categories as $cat):

            $category = $cat['category'];
            ?>

            <div class="span12" >
                <h3 >
            <?php echo $category ?></h3> 
            </div>
            <?php
            $query = "SELECT * FROM GOAL WHERE category = '$category' AND leafNumber = $leaf;";
            $goals = $db->query($query);
            ?>
            <div class="span 12" >
                <?php
                foreach ($goals as $goal):
                    ?>
                    <div >
                        <div class="span2">
                            <form action ="dbFunctions/editItem.php" method="POST"> 
                                <input type ="hidden"  name="editId" value="<?php echo $goal['idGoals']; ?>">
                                <button type="submit" class="btn btn-large btn-success">Edit this item</button>
                            </form>
                        </div>
                        <div class="span10">
                            <p>Point value: <?php echo ' ' . $goal['leafPoints'] ?> </p>
                            <h5><?php echo trim($goal['description']); ?></h5>
                            <?php
                            if (!empty($goal['webLink1'])) {
                                echo trim($goal['webLink1Text']) . "  "
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
                            <HR SIZE="3">
                        </div>

                    </div>
                    <?php
                endforeach;
                ?>
            </div>
            <?php
        endforeach;
        ?>
    </div>

    <?php
}
?>