<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
$id = $_POST["editId"];
if (!isset($id)){/* Redirect browser */
header("Location: http://ps11.pstcc.edu/~c2530a11/GreenOffice/adminWorksheet.php"); 
/* Make sure that code below does not get executed when we redirect. */
exit;}
$idGoals = $id + 0;
require_once 'db.php';
echo 'post' . $id;
$db = connectDatabase();
$query = "SELECT * FROM GOAL where idGoals = " . $idGoals . ";";
$stmt = $db->prepare($query);
$stmt->execute();
$item = $stmt->fetch(PDO::FETCH_ASSOC);

$goalId = $item['idGoals'];
$category = $item['category'];
$leafNumber = $item['leafNumber'];
$description = $item['description'];
$leafPoints = $item['leafPoints'];
$webLink1 = $item['webLink1'];
$webLink1Text = $item['webLink1Text'];
$webLink2 = $item['webLink2'];
$webLink2Text = $item['webLink2Text'];
$webLink3 = $item['webLink3'];
$webLink3Text = $item['webLink3Text'];
$otherNotes = $item['otherNotes'];
$required = $item['required'];
$availability = $item['availability'];
echo 'leaf' . $leafNumber;
?>

<html>
    <head>
        <title> Edit Item</title>
        <?php
        require_once 'headPathFix.php';
        include_once 'pageTopFix.php';
        ?>
    </head>
    <body>
        <?php
        navbar('administration');
        jumbotron('Edit Item');
        ?>
        <div class="container-fluid">              
            <div class="row-fluid"> 
                <div class="span1"></div>
                <div class ="span5">
                    <form action="dbUpdate.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Edit Goals</h3></legend>
                            <p>
                                Edit any values that need changed, add data as needed.  What is shown on screen is what will save back into the database.
                            </p>
                            <label><h5>Leaf Level</h5></label>
                            <input type="hidden" name="idGoals" value="<?php echo $goalId; ?>">
                            <label class="radio inline">
                                <input type="radio" name="leafNumber" 
                                <?php
                                if ($leafNumber === '1') {
                                    echo 'checked';
                                }
                                ?> 
                                       value="1" >1
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber"  
                                <?php
                                if ($leafNumber === '2') {
                                    echo 'checked';
                                }
                                ?> 
                                       value="2" >2
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber" 
                                <?php
                                if ($leafNumber === '3') {
                                    echo 'checked';
                                }
                                ?>
                                       value="3" >3
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber"                                        
                                <?php
                                if ($leafNumber === '4') {
                                    echo 'checked';
                                }
                                ?>
                                       value="4" >4
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber" 
                                <?php
                                if ($leafNumber === '0') {
                                    echo 'checked';
                                }
                                ?>
                                       value="0" >Wildcard
                            </label>

                            <label><h5>Change Category</h5></label> 
                            <?php
                            $db = connectDatabase();
                            $query = "SELECT * FROM CATEGORY;";
                            $categories = $db->query($query);
                            ?>
                            <select class="input-block-level" name="category">
                                <?php
                                foreach ($categories as $cat):
                                    $c = $cat['category'];
                                    ?>
                                    <option
                                        <?php
                                echo 'value="'.$c.'" ';
                                if ($c === $category) {
                                    echo 'selected="selected"';
                                }
                                    ?>
                                        > 
                                            <?php 
                                            echo $c; ?>
                                    </option>
                                <?php endforeach;
                                ?>
                            </select>


                            <label><h5> Describe Goal </h5></label> 
                            <textarea class="input-block-level" rows="5" name="description"><?php echo $description;?></textarea>

                            <label><h5>Provide Link</h5></label>
                            <input class="input-block-level" type="url" placeholder="copy and paste link from browser" name="webLink1" value = "<?php echo $webLink1; ?>">
                                
                            <span class="help-block">Include the whole url including http:// and nothing but the url</span>

                            <label><h5> Link Note </h5></label>   
                            <textarea class="input-block-level" rows="3" name="webLink1Text" ><?php echo $webLink1Text; ?></textarea>

                            <label><h5>Add another link</h5></label>
                            <input class="input-block-level" type="url" placeholder="copy and paste link from browser" name="webLink2" value = "<?php echo $webLink2; ?>">
                            <label><h5> Note for this link</h5></label>   
                            <textarea class="input-block-level" rows="3" name="webLink2Text"><?php echo $webLink2Text; ?></textarea>

                            <label><h5>Add a third link</h5></label>
                            <input class="input-block-level" type="url" placeholder="copy and paste link from browser" name="webLink3" value = "<?php echo $webLink3; ?>">
                            <label><h5> Note for this link</h5></label>   
                            <textarea class="input-block-level" rows="3" name="webLink3Text"><?php echo $webLink3Text; ?></textarea>

                            <label><h5>Other notes not link related</h5></label>
                            <textarea class ="input-block-level" rows="3" name="otherNotes"><?php echo $otherNotes; ?></textarea>

                            <label><h5> Assign Points </h5></label> 
                            <label class="radio inline">
                                <input type="radio" name="points" 
                                        <?php
                                if ($leafPoints === '1') {
                                    echo 'checked';
                                }
                                ?>
                                       value="1" >1
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="points" 
                                        <?php
                                if ($leafPoints === '2') {
                                    echo 'checked';
                                }
                                ?>
                                       value="2" >2
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="points" 
                                        <?php
                                if ($leafPoints === '3') {
                                    echo 'checked';
                                }
                                ?>
                                       value="3" >3
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="points" 
                                        <?php
                                if ($leafPoints === '4') {
                                    echo 'checked';
                                }
                                ?>
                                       value="4" >4
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="points" 
                                        <?php
                                if ($leafPoints === '5') {
                                    echo 'checked';
                                }
                                ?>
                                       value="5" >5
                            </label>
                            <label class="checkbox inline">This item is required </label>
                            <input type ="checkbox" name="required" value=1 
                                    <?php
                                if ($required === '1') {
                                    echo 'checked';
                                }
                                ?>
                                   >
                            <label class="checkbox inline">Points awarded if item is unavailable</label>
                            <input type="checkbox" name="availability" value=1
                                    <?php
                                if ($availability === '1') {
                                    echo 'checked';
                                }
                                ?>
                                   >
                            <br /><br>
                            <button type="submit" class="btn btn-large btn-block btn-warning">Submit</button>
                        </fieldset>
                    </form>
                </div>
                <div class="span1"></div>
                <div class="span4">
                    <form action="dbDelete.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Delete this Goal</h3></legend>
                            <p>This will permanently delete the goal seen on the other side of the page. </p>
                            <h3>This can NOT be undone</h3>
                            </p>
                            <input type="hidden" name="leafNumber" value="<?php echo $leafNumber;?>">
                            <input type="hidden" name="idGoals" value="<?php echo $goalId; ?>">
                            <button type="submit" class="btn btn-large btn-block btn-danger">DELETE</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
