
<div class="row-fluid">         

    <h3>Log in</h3>				
    <form action="dbFunctions/userData.php" method="POST" class="form-horizontal">
        <fieldset>
            <input class="input-block-level" type="hidden" name="op" id="op" value="login">
            <label><h5>Your Pellissippi email address:</h5></label>
            <div class="input-append">
                <input class="span8" id="email" name="email" type="text">
                <span class="add-on" style="color: black">@pstcc.edu</span>
            </div>
            Your Password:<br>
            <input class="input-block-level" type="password" id="pass" name="pass" ><br /><br />	
            <button type="submit" id="login" name="login" class="btn btn-large btn-block btn-warning" value="login"> Login</button>                            
        </fieldset>
    </form>

    <h3>Create an account</h3>
    <a href="userProfile.php" class="btn btn-large btn-block btn-warning">Create User</a> 
    
    <h3>Change password</h3>
    <p>
    <form action="dbFunctions/userData.php" method="POST" class="form-horizontal">
        <fieldset>
            <input  type="hidden" name="op" id="op2" value="change">
            <label><h5>Your Pellissippi email address:</h5></label>
            <div class="input-append">
                <input class="span8" id="email2" name="email" type="text">
                <span class="add-on" style="color: black" >@pstcc.edu</span>
            </div>
            Current password:<br>
            <input class="input-block-level" type="password" id="pass2" name="pass" ><br />
            New password:<br>
            <input class="input-block-level" type="password" id="newpass" name="newpass" ><br /><br />
            Confirm new password:<br>
            <input class="input-block-level" type="password" id="newpass2" name="newpass2" ><br /><br />
            <button type="submit" id="change" value="change" name="change" class="btn btn-large btn-block btn-danger">Change password</button>
        </fieldset>
    </form>
    <h3>Forgot password</h3>
    <p>
    <form action="dbFunctions/userData.php" method="POST" class="form-horizontal">
        <fieldset>
            <input  type="hidden" name="op" id="op3" value="forgot">
            <label><h5>Your Pellissippi email address:</h5></label>
            <div class="input-append">
                <input class="span8" id="email3" name="email" type="text">
                <span class="add-on" style="color: black">@pstcc.edu</span>
            </div><br /><br />
            <button type="submit" id="forgot" name="forgot" value="forgot" class="btn btn-large btn-block btn-warning">Forgot password</button>
        </fieldset>
    </form>
</div> 


