<?php
session_name('greenOffice');
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once 'dbFunctions/db.php'; 

function getCategoryList() {
    $db = connectDatabase();
    $query = "SELECT * FROM CATEGORY;";
    $categories = $db->query($query);
    ?>
    <select class="input-block-level" name="category">
        <?php
        foreach ($categories as $cat):
            $category = $cat['category'];
            ?>
            <option><?php echo "$category"; ?></option>
        <?php endforeach;
        ?>
    </select>
    <?php
}

function getDepartmentList() {
    $db = connectDatabase();
    $query = "SELECT * FROM DEPARTMENT;";
    $departments = $db->query($query);
    ?>
<select class="input-block-level" id="department" name="department" required="required">
        <?php
        foreach ($departments as $dpt):
            $department = $dpt['department'];
            ?>
            <option><?php echo "$department"; ?></option>
        <?php endforeach;
        ?>
    </select>
    <?php
}

function getCampusList() {
    $db = connectDatabase();
    $query = "SELECT * FROM CAMPUS;";
    $campuses = $db->query($query);
    ?>
<select class="input-block-level" id="campus" name="campus" required="required">
        <?php
        foreach ($campuses as $camp):
            $campusName = $camp['campusName']; 
            $campus = $camp['campus'];
            ?>
            <option value="<?php echo $campus; ?>"><?php echo "$campusName"; ?></option>
    <?php endforeach;
    ?>
    </select>
    <?php
}
?>