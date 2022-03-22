<?php

$errors = [0 => '', 1 => ''];
$sticky_values = [0 => '', 1 => '', 2 => 0];

if (isset($_POST['add_student'])){
    if (empty($_POST['name'])){
        $errors[0] = '<p class="error">Feld ist erforderlich</p>';
    }
    else{
        $sticky_values[0] = $_POST['name'];
    }
    if (empty($_POST['firstname'])){
        $errors[1] = '<p class="error">Feld ist erforderlich</p>';
    }    else{
        $sticky_values[1] = $_POST['firstname'];
    }
    $sticky_values[2] = $_POST['zip'];
    if($errors[0] == '' and $errors[1] == ''){
        $db->insert_into_student($_POST['name'], $_POST['firstname'], $_POST['zip']);
        $sticky_values = [0 => '', 1 => '', 2 => 0];
    }
}

echo'
<form method="post">
    <div class="container" id="form-container">
        <div class="row"><h2>Student/in erfassen</h2></div>
        <div class="row">
            <div class="col-md-3"><label for="name">Name:</label></div>
            <div class="col-md-9"><input type="text" name="name" id="name" value="'. $sticky_values[0] .'">'. $errors[0] .'</div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="firstname">Vorname:</label></div>
            <div class="col-md-9"><input type="text" name="firstname" id="firstname" value="'. $sticky_values[1] .'">'. $errors[1] .'</div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="zip">Ortschaft:</label>
            </div>
            <div class="col-md-9">
                <select id="zip" name="zip">';
                foreach ($db->select_places() as $place){
                    if($sticky_values[2] == $place['id']){
                        $checked = 'selected';
                    }
                    else{
                        $checked = '';
                    }
                    echo '<option value="'. $place['id'] .'" '. $checked .'>' . $place['name'] .'</option>';
                }
echo '
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><input type="submit" class="btn btn-dark" value="Student erfassen" name="add_student"></div>
        </div>
    </div>
</form>';
