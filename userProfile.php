<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
?>
<html>
    <head>
        <title>User Profile</title>

        <?php
        require_once 'dbFunctions/db.php';
        require_once 'dbFunctions/headCommon.php';
        include_once 'writeHTML/pageTop.php';
        require 'writeHTML/getLists.php';
        
        ?>
        
        <script src="js/userProfile.js"></script>
    </head>
    <body>
        <?php
        navbar('myProfile');
        jumbotron('My Profile');
        ?>

        <div class="container-fluid">
            <div class="row-fluid"> 
                <?php
                /* if (session){get userId & load page to current user values */
                ?>
                <div id="ajaxResponse"></div>
               

                <form action="dbFunctions/userData.php" id="userForm" method="POST" class="form-horizontal">
                    <fieldset> 
                        <div class="span1"></div>
                        <div class="span3"> 
                            <h3>Create or Edit Your Account</h3> 
                            <p>Your Pellissippi email address is required, but please do not use the same password as your email account.</p>

                            <label><h5>Your Pellissippi email address:</h5></label> 
                            <div class="input-append">
                                <input class="span8" id="email" name="email" type="text" required="required">
                                <span class="add-on" style="color: black">@pstcc.edu</span>
                            </div>

                            <label><h5>Create Password:</h5></label>
                            <input class="input-block-level" id="pass" type="password" name="pass" required="required"><br /><br />  
                            <span class="help-block">Password cannot be changed on this page</span>
                        </div>
                        <div class="span3">
                            <label><h5>Your first name:</h5></label>
                            <input class="input-block-level" id="firstName" type="text" name="firstName" required="required"><br /><br />  

                            <label><h5>Your last name:</h5></label>
                            <input class="input-block-level" id="lastName" type="text" name="lastName" required="required"><br /><br /> 


                            <label><h5>Your Office Number:</h5></label>
                            <input class="input-block-level" id="officeNumber" type="text" name="officeNumber" required="required" >
                            <span class="help-block">Input example MC235</span>
                            
                            <span class="help-block">Check the box if you share an office</span>
                            <label class="checkbox inline"><h5>
                                    <input type ="checkbox" id="sharedOffice" name="sharedOffice" value="1">I share an office:</h5></label>
                        </div> 
                        <div class="span3">
                            <label><h5>What department do you work in?</h5></label>            
                            <?php
                            getDepartmentList();
                            ?> 

                            <label><h5>What campus do you work at?</h5></label>            
                            <?php
                            getCampusList();
                            ?>                            

                            <label><h5>About your office:</h5></label> 
                            <span class="help-block">Describe your desk location if your office is shared, or use this for a short note about your office</span>  
                            <textarea class="input-block-level" id="deskLocation" rows="3" name="deskLocation"></textarea>

                        </div>
                    </fieldset>
                    <button type="submit" name="button" id="new" class="btn btn-large btn-block btn-success" value="new">Create New User</button>
                    <button type="submit" name="updatebutton" id="update" class="btn btn-large btn-block btn-warning" value="update">Update My Account</button>
                </form>
            </div>
        </div>

    </body>
</html>