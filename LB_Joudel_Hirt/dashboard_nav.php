<?php

    if(!isset($_SESSION['show_students']) or !$_SESSION['show_students'])
    {
        if(!isset($_SESSION['show_users']) or !$_SESSION['show_users']){
            $dashboard_section = 'Dashboard';
            $_SESSION['show_users'] = false;
            $_SESSION['show_students'] = false;
            $_SESSION['update_student'] = false;
            $_SESSION['show_dashboard'] = true;
            $_SESSION['update_user'] = false;
            $_SESSION['update_profile'] = false;

            $_SESSION['show_students_btn'] = true;
            $_SESSION['show_users_btn'] = true;
            $_SESSION['show_dashboard_btn'] = false;
        }
        else{
            $dashboard_section = $_SESSION['dashboard_section'];
        }
    }
    else{
        $dashboard_section = $_SESSION['dashboard_section'];
    }

    if (isset($_POST['btn-show-student']))
    {
        $dashboard_section = 'Studenten';
        $_SESSION['show_students'] = true;
        $_SESSION['show_users'] = false;
        $_SESSION['show_dashboard'] = false;
        $_SESSION['update_student'] = false;
        $_SESSION['update_user'] = false;
        $_SESSION['update_profile'] = false;

        $_SESSION['show_students_btn'] = false;
        $_SESSION['show_users_btn'] = true;
        $_SESSION['show_dashboard_btn'] = true;
    }
    elseif (isset($_POST['btn-show-user']))
    {
        $dashboard_section = 'Mitarbeiter';
        $_SESSION['show_students'] = false;
        $_SESSION['show_users'] = true;
        $_SESSION['show_dashboard'] = false;
        $_SESSION['update_student'] = false;
        $_SESSION['update_user'] = false;
        $_SESSION['update_profile'] = false;


        $_SESSION['show_students_btn'] = true;
        $_SESSION['show_users_btn'] = false;
        $_SESSION['show_dashboard_btn'] = true;
    }
    elseif (isset($_POST['btn-show-dashboard']))
    {
        $dashboard_section = 'Dashboard';
        $_SESSION['show_students'] = false;
        $_SESSION['show_users'] = false;
        $_SESSION['show_dashboard'] = true;
        $_SESSION['update_student'] = false;
        $_SESSION['update_user'] = false;
        $_SESSION['update_profile'] = false;

        $_SESSION['show_students_btn'] = true;
        $_SESSION['show_users_btn'] = true;
        $_SESSION['show_dashboard_btn'] = false;
    }
    elseif (isset($_POST['btn-update-profile']))
    {
        $dashboard_section = 'Profil bearbeiten';

        $_SESSION['show_students'] = false;
        $_SESSION['show_users'] = false;
        $_SESSION['show_dashboard'] = false;
        $_SESSION['update_student'] = false;
        $_SESSION['update_user'] = false;
        $_SESSION['update_profile'] = true;

        $_SESSION['show_students_btn'] = false;
        $_SESSION['show_users_btn'] = false;
        $_SESSION['show_dashboard_btn'] = true;
    }

echo '<div class="row">';
echo '<div class="col-lg-9">';
echo "<h1>$dashboard_section</h1>";
echo '</div>';
echo '<div class="col-lg-3">';
echo '<form method="post">';

if(!$_SESSION['user_type'] and isset($_SESSION['update_profile']) and !$_SESSION['update_profile']){
    echo '<button type="submit" class="btn btn-dark" id="btn-update-profile" name="btn-update-profile">Profil bearbeiten</button>';
}
if ($_SESSION['show_dashboard_btn'])
{
    echo '<button type="submit" class="btn btn-dark" id="btn-show-dashboard" name="btn-show-dashboard">Dashboard anzeigen</button>';
}
if($_SESSION['show_students_btn'])
{
    echo '<button type="submit" class="btn btn-dark" id="btn-show-student" name="btn-show-student">Studenten anzeigen</button>';
}
if ($_SESSION['show_users_btn'] and $_SESSION['user_type'])
{
    echo '<button type="submit" class="btn btn-dark" id="btn-show-user" name="btn-show-user">Mitarbeiter anzeigen</button>';
}

echo '</form>';
echo '<form method="post" action="dashboard.php">
          <input name="logout" id="logout" value="Logout" class="btn btn-danger" type="submit">
          </form>';
echo '</div></div>';