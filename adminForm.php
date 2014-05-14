<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
if (!isset($_SESSION['roll'])||$_SESSION['roll']<4){
    require 'index.php';
    exit(); 
}
?> 
<html>
    <head>
        <title> Edit Worksheet</title>

        <?php
        require_once 'dbFunctions/headCommon.php';
        require_once 'dbFunctions/db.php';        
        include_once 'writeHTML/pageTop.php';        
        require 'writeHTML/getLists.php';
        ?>
    </head>
    <body>
        <?php
        
        navbar('administration');
        jumbotron('Administration');
        ?>

        <div class="container-fluid">
            <div class="row-fluid"> 

                <div class="span1"></div>
                <div class ="span5">
                    <form action="dbFunctions/dbSubmit.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Worksheet Goals</h3></legend>
                            <label><h5>Leaf Level</h5></label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber" value="1" >1
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber" value="2" >2
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber" value="3" >3
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber" value="4" >4
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="leafNumber" value="0" >Wildcard
                            </label>

                            <label><h5>Select Category</h5></label> 
                            <?php                            
                            getCategoryList();
                            ?>
                            <span class="help-block">Use Add Category to add a category</span>

                            <label><h5> Describe Goal </h5></label> 
                            <textarea class="input-block-level" rows="5" name="description"></textarea>

                            <label><h5>Provide Link</h5></label>
                            <input class="input-block-level" type="url" placeholder="copy and paste link from browser" name="webLink1">
                            <span class="help-block">Include the whole url including http://</span>

                            <label><h5> Link Note </h5></label>   
                            <textarea class="input-block-level" rows="3" name="webLink1Text"></textarea>

                            <label><h5>Add another link</h5></label>
                            <input class="input-block-level" type="url" placeholder="copy and paste link from browser" name="webLink2">
                            <label><h5> Note for this link</h5></label>   
                            <textarea class="input-block-level" rows="3" name="webLink2Text"></textarea>

                            <label><h5>Add a third link</h5></label>
                            <input class="input-block-level" type="url" placeholder="copy and paste link from browser" name="webLink3">
                            <label><h5> Note for this link</h5></label>   
                            <textarea class="input-block-level" rows="3" name="webLink3Text"></textarea>

                            <label><h5>Other notes not link related</h5></label>
                            <textarea class ="input-block-level" rows="3" name="otherNotes"></textarea>

                            <label><h5> Assign Points </h5></label> 
                            <label class="radio inline">
                                <input type="radio" name="points" value="1" >1
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="points" value="2" >2
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="points" value="3" >3
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="points" value="4" >4
                            </label>
                            <label class="radio inline">
                                <input type="radio" name="points" value="5" >5
                            </label>
                            <label class="checkbox inline">This item is required </label>
                            <input type ="checkbox" name="required" value="TRUE">
                            <label class="checkbox inline">Points awarded if item is unavailable</label>
                            <input type="checkbox" name="availability" value="TRUE">
                            <br /><br>
                            <button type="submit" class="btn btn-large btn-block btn-warning">Submit</button>
                        </fieldset>
                    </form>
                </div>
                <div class="span1">

                </div>
                <div class="span4">
                    <form action="dbFunctions/addCat.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Add Category</h3></legend>
                            <label><h5>Add a new Category</h5></label>
                            <input class="input-block-level" type="text" placeholder="enter a category name" name="catName">
                            <span class="help-block">This creates a new category,<br /> to edit the category list, use the edit below</span>
                            <br />
                            <button type="submit" class="btn btn-large btn-block btn-warning">Submit</button>
                        </fieldset>
                    </form>
                    <form action="dbFunctions/editCat.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Edit Category List</h3></legend>

                            <label><h5>Select the category to edit</h5></label> 
                            <?php
                            getCategoryList();
                            ?>
                            <label><h5>Enter the new name for this category</h5></label>
                            <input class="input-block-level" type="text" placeholder="enter new category name" name="editName"> 
                            <br /><br />
                            <button type="submit" class="btn btn-large btn-block btn-warning">Submit</button>
                        </fieldset>
                    </form>
                    <form action="dbFunctions/addDepartment.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Add Department</h3></legend>
                            <label><h5>Add a new Department</h5></label>
                            <input class="input-block-level" type="text" placeholder="enter a department name" name="deptName">
                            <span class="help-block">This creates a new department,<br /> to edit the department list, use the edit below</span>
                            <br />
                            <button type="submit" class="btn btn-large btn-block btn-warning">Submit</button>
                        </fieldset>
                    </form>
                    <form action="dbFunctions/editDepartment.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Edit Department List</h3></legend>

                            <label><h5>Select the category to edit</h5></label> 
                            <?php
                            getDepartmentList();
                            ?>
                            <label><h5>Enter the new name for this department</h5></label>
                            <input class="input-block-level" type="text" placeholder="enter new department name" name="editName"> 
                            <br /><br />
                            <button type="submit" class="btn btn-large btn-block btn-warning">Submit</button>
                        </fieldset>
                    </form>
                    <form action="dbFunctions/addCampus.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Add Campus</h3></legend>
                            <label><h5>Add a new Campus</h5></label>
                            <input class="input-block-level" type="text" placeholder="enter a campus name" name="campName">
                            <br /><br />
                            <input class="input-block-level" type="text" placeholder="enter campus initials" name="campus">
                            <span class="help-block">This creates a new campus,<br /> to edit the campus list, use the edit below</span>
                            <br />
                            <button type="submit" class="btn btn-large btn-block btn-warning">Submit</button>
                        </fieldset>
                    </form>
                    <form action="dbFunctions/editCampus.php" method="POST" class="form-horizontal">
                        <fieldset>
                            <legend><h3>Edit Campus List</h3></legend>

                            <label><h5>Select the campus to edit</h5></label> 
                            <?php
                            getCampusList();
                            ?>
                            <label><h5>Enter the new name for this campus</h5></label>
                            <input class="input-block-level" type="text" placeholder="enter new campus name" name="editName">
                            <br /><br />
                            <input class="input-block-level" type="text" placeholder="enter campus initials" name="campus">
                            <br /><br />
                            <button type="submit" class="btn btn-large btn-block btn-warning">Submit</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>


<?php

