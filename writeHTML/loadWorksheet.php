<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
// to populate the leaf worksheets

function getCategories($leafNumber, $db) {

    $leaf = intval($leafNumber);
    $query = "SELECT DISTINCT category FROM GOAL WHERE leafNumber = $leaf;";
    $categories = $db->query($query);

    foreach ($categories as $cat):
        $category = $cat['category'];
        ?>
        <div class="panel panel-default">
            <div class="panel-heading" >
                <h3 class="panel-title">
        <?php echo $category ?></h3> 
                <hr size="3" />
            </div>
            <?php
            $query = "SELECT * FROM GOAL WHERE category = '$category' AND leafNumber = $leaf;";
            $goals = $db->query($query);
            ?>
            <div class="panel-body" >

                <?php
                foreach ($goals as $goal):                    
                    ?>
                    <div class="row-fluid">
                        <div class="span2">
                            <i class="icon-ok icon-white"></i>
                            <label class="checkbox inline">Point value: <?php echo ' ' . $goal['leafPoints'] ?> </label>
                            <input type ="checkbox"  name="myPoints[]" value="<?php echo $goal['idGoals']; ?>">  
                            <?php 
                            if ($goal['required'] == 1) { ?>
                                <i class="icon-leaf icon-white"></i>
                            <?php }
                            if ($goal['availability']==1) { ?>
                                
                            <label class="checkbox inline">not available to me </label>
                            <input type ="checkbox"  name="myAvailability[]" value="<?php echo $goal['idGoals']; ?>"> 
                            <i class="icon-home icon-white"></i> 
                            <?php }?>
                        </div>
                        <div class="span9">
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
                            <hr /> 
                        </div>                    
                    </div>
                <?php endforeach; ?>
            </div> 
        <?php endforeach; ?>
    </div>
<?php } 
