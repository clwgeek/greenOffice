<?php

session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
//
require_once 'db.php';
//
$db = connectDatabase();
//
$debug = FALSE;
//
/* @var $op string operation what are we trying to accomplish? */
$op = $_POST['op'];
$op2 = $_POST['button'];
if (/* $op !== 'new'  && */ $op !== 'login' && $op !== 'change' && /* $op!== 'forgot' && */
        $op2 !== 'new' && $op2 !== 'update') {
    $msg = 'Unknown request';
}
//
if ($op2 == 'update') {
    $msg = updateAccount($db);
    echo $msg;
    exit();
}
//
if ($op2 == 'new') {
    $msg = createUser($db);
    echo $msg;
    exit();
}
//
if ($op == 'login' || $op == 'change') {
    $msg = login($db, $op);
    echo $msg;
    exit();
}
//
if ($op == 'forgot') {
    $msg = forgot($db);
    echo $msg;
    exit();
}

//
function getInfo($idUser, $db) {
    $info = "SELECT rollId, currentLeafLevel, firstName FROM USER WHERE idUser = $idUser";
    try {
        $qry = $db->prepare($info);
        $qry->execute();
        $userInfo = $qry->fetch();
        $rollId = $userInfo['rollId'];
        $leafLevel = $userInfo['currentLeafLevel'];
        $firstName = $userInfo['firstName'];
        $_SESSION['roll'] = $rollId;
        $_SESSION['leafLevel'] = $leafLevel;
        $_SESSION['firstName'] = $firstName;
        //setcookie("roll", $rollId,  time()+600, '/');
        //setcookie("leafLevel", $leafLevel, time()+600, '/');
        //setcookie("firstName", $firstName,  time()+600, '/');
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
}

// just a little extra security measure
function getPostVariable($var) {
    $val = $_POST[$var];
    if (get_magic_quotes_gpc()) {
        $val = stripslashes($val);
    }
    return $val;
}

// with debug switch to either show or hide actual error strings from sql & hash
function fail($pub, $pvt = '') {
    global $debug;
    $msg = $pub;
    if ($debug && $pvt !== '') {
        $msg .= ": $pvt";
    }
    return $msg;
}

//
function encode($pass) {
    $cost = 11;
    /* To generate the salt, first generate enough random bytes. Because
     * base64 returns one character for each 6 bits, the we should generate
     * at least 22*6/8=16.5 bytes, so we generate 17. Then we get the first
     * 22 base64 characters
     */
    $salt = substr(base64_encode(openssl_random_pseudo_bytes(17)), 0, 22);
    /* As blowfish takes a salt with the alphabet ./A-Za-z0-9 we have to
     * replace any '+' in the base64 string with '.'. We don't have to do
     * anything about the '=', as this only occurs when the b64 string is
     * padded, which is always after the first 22 characters.
     */
    $salt = str_replace("+", ".", $salt);
    /* Next, create a string that will be passed to crypt, containing all
     * of the settings, separated by dollar signs
     */
    $param = '$' . implode('$', array(
                "2y", //select the most secure version of blowfish (>=PHP 5.3.7)
                str_pad($cost, 2, "0", STR_PAD_LEFT), //add the cost in two digits
                $salt //add the salt
    ));
    //now do the actual hashing
    return crypt($pass, $param);
}

/*
 * Check the password against a hash generated by the generate_hash
 * function.
 */

function verify($pass, $hash) {
    /* Regenerating the with an available hash as the options parameter should
     * produce the same hash if the same password is passed.
     */
    return crypt($pass, $hash) == $hash;
}

//php 5.5 ready
//function encode($pass) {
//    $hash = password_hash($pass, PASSWORD_BCRYPT);
//    return $hash;
//}
//php 5.5 ready
//function verify($pass, $hash) {
//    if (password_verify($pass, $hash)) {
//        return 'TRUE';
//    } else {
//        fail('Your password did not match');
//    }
//}
function updateAccount($db) {
    //$userId = $_COOKIE['leming'];
    $userId = $_SESSION['leming'];
    $department = $_POST['department'];
    $officeNumber = getPostVariable('officeNumber');
    $lastName = getPostVariable('lastName');
    $firstName = getPostVariable('firstName');
    $sharedOffice = $_POST['sharedOffice'];
    $deskLocation = getPostVariable('deskLocation');
    $campus = $_POST['campus'];
//
    $update = 'UPDATE `USER` SET department = :department, officeNumber = :officeNumber,'
            . ' lastName = :lastName, firstName = :firstName, sharedOffice = :sharedOffice, '
            . 'deskLocation = :deskLocation, campus = :campus WHERE idUser = :idUser ';
    try {
        $stmt = $db->prepare($update);
//
        $stmt->bindValue(':department', $department) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(':officeNumber', $officeNumber) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(':lastName', $lastName) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(':firstName', $firstName) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(':sharedOffice', $sharedOffice) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(':deskLocation', $deskLocation) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(':campus', $campus) || fail('MySQL bind value', $db->error);
        $stmt->bindValue('idUser', $userId);
//
        $stmt->execute();
    } catch (PDOException $exc) {
        $msg = fail('There was an error with your request, please try again later', $exc);
        return $msg;
    }
    return 'User Updated';
}

//
function createUser($db) {
    $pass = getPostVariable('pass');
    /* Don't let them spend more of our CPU time than we were willing to.
     * Besides, bcrypt happens to use the first 72 characters only anyway. */
    if (strlen($pass) > 72) {
        $msg = 'The supplied password is too long';
        return $msg;
    }
    if (strlen($pass) < 7) {
        $msg = 'The supplied password is too short, must be at least 7 characters long';
        return $msg;
    }
    $hash = encode($pass);
    $email = getPostVariable('email');
    /* check email alpha numeric and reasonable length */
    if (!ctype_alnum($email)) {
        $msg = 'Invalid email, enter only the first part not the @pstcc.edu' . $email;
        return $msg;
    }
    $department = $_POST['department'];
    $officeNumber = getPostVariable('officeNumber');
    $lastName = getPostVariable('lastName');
    $firstName = getPostVariable('firstName');
    $sharedOffice = $_POST['sharedOffice'];
    $deskLocation = getPostVariable('deskLocation');
    $campus = $_POST['campus'];
//
    if (strlen($hash) < 20) {
        $msg = 'Failed to hash new password';
        return $msg;
    }
//
    $insert = 'INSERT INTO USER (email, password, department, officeNumber, '
            . 'lastName, firstName, sharedOffice, deskLocation, campus) VALUES (?, ?,?,?,?,?,?,?,?)';
    try {
        $stmt = $db->prepare($insert);
        $stmt->bindValue(1, $email) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(2, $hash) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(3, $department) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(4, $officeNumber) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(5, $lastName) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(6, $firstName) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(7, $sharedOffice) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(8, $deskLocation) || fail('MySQL bind value', $db->error);
        $stmt->bindValue(9, $campus) || fail('MySQL bind value', $db->error);
        //      if no errors user is created
        $stmt->execute();
        $idUser = $db->lastInsertId();

        /* Figure out why this flailed - maybe the username is already taken?
          since user name is the email the email must be unique, not using it as
         * primary key in case email needs changed for some reason */
    } catch (PDOException $exc) {
        if (strpos($exc, '1062') !== false)/* ER_DUP_ENTRY */ {
            $msg = fail('This email is already in our system');
            return $msg;
        } else {
            $msg = fail('There was an error with your request, please try again later', $exc);
            return $msg;
        }
    }
    $_SESSION['leming'] = $idUser;
    //setcookie("leming", $idUser,  time()+600,'/');
    getInfo($idUser, $db);
    return 'User Created';
}

//
function login($db, $op) {

    $email = getPostVariable('email');
    $select = 'select password, idUser from USER where email= :email';
    try {
        $stmt = $db->prepare($select);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $f = $stmt->fetch();
        $hash = $f['password'];
        $idUser = $f['idUser'];
    } catch (Exception $exc) {
        $msg = fail('There was an error finding you, please try again later', $exc);
        //echo $exc->getTraceAsString();
        return $msg;
    }
    $pass = $_POST['pass'];
    if (verify($pass, $hash)) {
        $_SESSION['leming'] = $idUser;
        //setcookie("leming", $idUser,  time()+600,'/');
        getInfo($idUser, $db);
        $msg = 'Authentication succeeded';
    } else /* password not verified */ {
        $msg = fail('Password Authentication failed');
        $op = 'fail'; // Definitely not 'change'
        return $msg;
    }
    if ($op == 'change') {

        $newpass = $_POST['newpass'];
        $newpass2 = $_POST['newpass2'];
        if ($newpass !== $newpass2){
            return 'Your password and confirm do not match\n Please try again';
        }
        if (strlen($newpass) > 72) {
            return 'The new password is too long';
        }
        if (strlen($newpass) < 7) {
            return 'The new password is too short';
        }
        $hash = encode($newpass);
        if (strlen($hash) < 20) {
            return 'Failed to hash new password, try a longer or more complex password';
        }
        $updatePass = 'update USER set password=:newpass where idUser= :idUser';
        try {
            $stmt = $db->prepare($updatePass);
            $stmt->bindParam(':newpass', $hash);
            $stmt->bindParam(':idUser', $idUser);
            $stmt->execute();
            $msg = 'Password changed';
        } catch (Exception $exc) {
            $msg = fail('Unable to change to the password requested', $exc);
            // echo $exc->getTraceAsString();
            return $msg;
        }
        return $msg;
    }
    return $msg;
}

function forgot($db) {
    $pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $hash = encode($pass);
    $email = getPostVariable('email');
    /* check email alpha numeric and reasonable length */
    if (!ctype_alnum($email)) {
        $msg = 'Invalid email, enter only the first part not the @pstcc.edu' . $email;
        return $msg;
    }
    //make sure user is in system, get id so consistant set pswd by id
    $select = 'select idUser from USER where email= :email';
    try {
        $stmt = $db->prepare($select);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $f = $stmt->fetch();        
        $idUser = $f['idUser'];
    } catch (Exception $exc) {
        $msg = fail('There was an error finding you, please try again later', $exc);
        return $msg;
    }
    unset($stmt);
    $mail = $email.'@pstcc.edu';
    $subject = 'Green Office password reset';
    $message = "Your password has been set to $pass\n You should change it as soon as you revisit our site.";
    
    $updatePass = 'update USER set password=:newpass where idUser= :idUser';
    try {
        $stm = $db->prepare($updatePass);
        $stm->bindParam(':newpass', $hash);
        $stm->bindParam(':idUser', $idUser);
        $stm->execute();
        $msg = 'Check your email for new password';
        mail($mail,$subject,$message,"From: scvol@pstcc.edu");
    } catch (Exception $exc) {
        $msg = fail('Unable to change to the password requested', $exc);
        // echo $exc->getTraceAsString();
        return $msg;
    }
    return $msg;
}
