<?php
$_SESSION['dashboard_section'] = "Mitarbeiter";
if (isset($_POST['delete-user-btn']) && $_POST['user-id'] != "")
{
    $_SESSION['show_users'] = true;
    $db->delete_user($_POST['user-id']);
    header('Refresh: 0;');
}
elseif (isset($_POST['update-user-btn']) && $_POST['user-id'] != "")
{
    $_SESSION['update_user'] = true;
    $_SESSION['show_users_btn'] = true;
    $_SESSION['user_id'] = $_POST['user-id'];
    header('Refresh: 0;');
}
$_SESSION['dashboard_section'] = "Mitarbeiter";

echo '<div class="row" id="user-table">';
echo '<div class="col-md-12">';
echo '<table>';
echo '<th>Vorname</th><th>Nachname</th><th>E-Mail</th><th>Adminrechte</th><th style="text-align: center">
</th><th style="text-align: center">';
foreach ($db->select_all_users() as $row){
    echo '<form method="post">';
    echo '<input type="text" name="user-id" value="'. $row['id'] .'" style="display: none;">';
    echo '<tr><td>'.$row['firstname']. '</td><td>' . $row['name'] .
        '</td><td>'. $row['email'] .'</td><td>'. $row['user_type'] .
        '</td><td><button type="submit" class="btn btn-dark" name="update-user-btn">Ändern</button></td>
            </td><td><button type="submit" class="btn btn-dark" name="delete-user-btn">Löschen</button></td></tr>';
    echo '</form>';
}
echo '</table>';
echo '</div></div>';