<?php

if (isset($_POST['delete-student-btn']) && $_POST['student-id'] != "")
{
    $_SESSION['show_student'] = true;
    $db->delete_student($_POST['student-id']);
    header('Refresh: 0;');
}
elseif (isset($_POST['update-student-btn']) && $_POST['student-id'] != "")
{
    $_SESSION['update_student'] = true;
    $_SESSION['show_students_btn'] = true;
    $_SESSION['student_id'] = $_POST['student-id'];
    header('Refresh: 0;');
}
else{
    $_SESSION['dashboard_section'] = "Studenten";
    echo '<div class="row" id="student-table">';
    echo '<div class="col-md-12">';
    echo '<table>';
    echo '<th>Vorname</th><th>Nachname</th><th>Ort</th><th style="text-align: center"><img src="./img/gear.svg" width="32"></th><th style="text-align: center"><img src="./img/radioactive.svg" width="32">';
    foreach ($db->select_all_students() as $row){
        echo '<form method="post">';
        echo '<input type="text" name="student-id" value="'. $row['ID'] .'" style="display: none;">';
        echo '<tr><td>'.$row['Vorname']. '</td><td>' . $row['Nachname'] .
            '</td><td>'. $row['Ort'] .
            '</td><td><button type="submit" class="btn btn-dark" name="update-student-btn">Ändern</button></td>
            </td><td><button type="submit" class="btn btn-dark" name="delete-student-btn">Löschen</button></td></tr>';
        echo '</form>';
    }
    echo '</table>';
    echo '</div></div>';
}