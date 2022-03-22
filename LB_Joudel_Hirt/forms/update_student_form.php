<?php

$name = '';
$first_name = '';
$zip = 0;

$student = $db->select_student($_SESSION['student_id']);

$name = $student['Vorname'];
$first_name = $student['Nachname'];
$zip = $student['PLZ'];


$selected = '';

if (isset($_POST['update_student'])){
    $id = $_SESSION['student_id'];
    $db->update_student($id,$_POST['name'],$_POST['first-name'], $_POST['zip']);
    $_SESSION['update_student'] = false;
    $_SESSION['show_student'] = true;
    header("Refresh:0;");
}

echo'
<form method="post">
    <div class="container" id="form-container">
        <div class="row"><h2>Student/in bearbeiten</h2></div>
        <div class="row">
            <div class="col-md-3"><label for="name">Name:</label></div>
            <div class="col-md-9"><input type="text" name="name" id="name" value="'. $name .'"></div>
        </div>
        <div class="row">
            <div class="col-md-3"><label for="first-name">Vorname:</label></div>
            <div class="col-md-9"><input type="text" name="first-name" id="first-name" value="'. $first_name .'"></div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for="zip">Ortschaft:</label>
            </div>
            <div class="col-md-9">
                <select id="zip" name="zip">';
foreach ($db->select_places() as $place){
    if ($place['id'] == $zip){
        echo '<option value="'. $place['id'] .'" selected>'. $place['zip'] . " " . $place['name'] .'</option>';
    }
    else{
        echo '<option value="'. $place['id'] .'">'. $place['zip'] . " " . $place['name'] .'</option>';
    }
    $selected = '';
}
echo '
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12"><input type="submit" class="btn btn-dark" value="Ändern" name="update_student"></div>
        </div>
    </div>
</form>';
